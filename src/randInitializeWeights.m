function W = randInitializeWeights(L_in, L_out)
%Initialise aléatoirement une matrice de taille (L_in, L_out)

W = zeros(L_out,L_in);

epsilon_init = 0.12;
W= rand(L_out, L_in)*2*epsilon_init - epsilon_init;

end