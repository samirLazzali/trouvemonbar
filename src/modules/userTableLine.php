<tr>
    <td><? print $user->id; ?></td>
    <td><? print $user->username; ?></td>
    <td><? print $user->email; ?></td>
    <td><? print ($user->admin?"Admin":"Utilisateur"); ?></td>
    <td><? print User::editLink($user->id); ?></td>
</tr>
