
%% =============== Chargement des données Et Initialisation des matrices ================

fprintf('Loading producs ratings dataset.\n\n');

%  Load data
M = csvread("data.csv");
M = M(2:end,2:end);
list_pdt = unique(M(:,1));
list_clt = unique(M(:,2));


list_clt = 1:max(list_clt);
    

nb_pdt = length(list_pdt);
nb_clt = length(list_clt);

mean_pdt = zeros(nb_pdt,1);
for i = 1:nb_pdt
  mean_pdt(i) = mean( M(find(M(:,1) == list_pdt(i)),3) );
end

Y = zeros(nb_pdt,nb_clt);
R = zeros(nb_pdt,nb_clt);
for i = 1:nb_pdt
  for j = 1:nb_clt
    for k = 1:length(M)
      if M(k,1)==list_pdt(i) && M(k,2) == list_clt(j)
        R(i,j) = 1;
        Y(i,j) = M(k,3);
      endif
    end
    if R(i,j) == 0
      Y(i,j) = mean_pdt(i);
    endif
  end
end
R
Y = normalizeRatings(Y, R,mean_pdt);

%  Affichage des données
imagesc(Y);
ylabel('Produit');
xlabel('Client');


mean_pdt = zeros(nb_pdt,1);
for i = 1:nb_pdt
  mean_pdt(i) = mean( M(find(M(:,1) == list_pdt(i)),3) );
end
Y = normalizeRatings(Y, R,mean_pdt);


%paramètres
nb_clt = size(Y, 2);
nb_pdt = size(Y, 1);
nb_features = 3;



% Initialisation des matrices
X = randn(nb_pdt, nb_features);
Theta = randn(nb_clt, nb_features);

initial_parameters = [X(:); Theta(:)];

% Options pour fmincg
options = optimset('GradObj', 'on', 'MaxIter', 100);

% Optimisation
% fmincg est un programme qui calcul rapidement et efficacement la déscente de
% gradient (à condition de lui donné la fonction de calcul de l'erreur J et 
% le vectur du gradient).
lambda = 10;
theta = fmincg (@(t)(cofiCostFunc(t, Y, R, nb_clt, nb_pdt, ...
                                nb_features, lambda)), ...
                initial_parameters, options);

X = reshape(theta(1:nb_pdt*nb_features), nb_pdt, nb_features);
Theta = reshape(theta(nb_pdt*nb_features+1:end), ...
                nb_clt, nb_features);
                
%% ================== Recommandation ====================
%  On prédit maintenant la note de tous les produits non notés
%   par des clients.

pb = X * Theta';
reco = zeros(5,nb_clt);
p = zeros(nb_pdt,nb_clt);
for i = 1:nb_pdt
  for j = 1:nb_clt
    if (R(i,j)==0)
      p(i,j) = pb(i,j);
    else
      p(i,j) = Y(i,j);
    endif
  end
end
p=p + mean_pdt;


for i = 1:nb_clt
  L = [];
  for j = 1:5
    m = 0;
    id = 0;
    for k = 1:nb_pdt
      if (p(k,i) > m && sum(L == k)==0)
        m = p(k,i);
        id = k;
      endif
    end
    reco(j,i) = id;
    L = [id L];
  end
end
p
reco

csvwrite('recomand.csv',reco);