function [J, grad] = cofiCostFunc(params, Y, R, nb_clt, nb_pdt, ...
                                  nb_param, lambda)
% Calcul l'erreur J et les gradients grad pour optimiser les paramètre

X = reshape(params(1:nb_pdt*nb_param), nb_pdt, nb_param);
Theta = reshape(params(nb_pdt*nb_param+1:end),nb_clt, nb_param);

         
J = 0;
X_grad = zeros(size(X));
Theta_grad = zeros(size(Theta));


M = (X*Theta'- Y).*R;

J = 0.5*sum( sum(M.**2 )) + ( (lambda*0.5)*sum(sum( Theta.**2 )) ) + ( (lambda*0.5)*sum(sum( X.**2 )) );

for i = 1:nb_pdt
  for k = 1:nb_param
    s= 0;
    for j = 1:nb_clt
      if R(i,j) == 1
        s = s + (X(i,:)*Theta(j,:)' - Y(i,j))*Theta(j,k);
      end
    end
    X_grad(i,k) = s + lambda*X(i,k);
  end
end

for j = 1:nb_clt
  for k = 1:nb_param
    s= 0;
    for i = 1:nb_pdt
      if R(i,j) == 1
        s = s + (X(i,:)*Theta(j,:)' - Y(i,j))*X(i,k);
      end
    end
    Theta_grad(j,k) = s + Theta(j,k)*lambda;
  end
end



% =============================================================

grad = [X_grad(:); Theta_grad(:)];

end
