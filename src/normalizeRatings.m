function Ynorm = normalizeRatings(Y, R,Ymean)
%Normalise les données
[m, n] = size(Y);

Ynorm = zeros(size(Y));
for i = 1:m
    idx = find(R(i, :) == 1);
    Ynorm(i, idx) = Y(i, idx) - Ymean(i);
end

end
