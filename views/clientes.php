<?php require_once '../views/header.php'; ?>

<div class="form-container">
    <h1>Lista de Usuários</h1>
    <table border="1">
        <tr>
            <td>nome</td>
            <td>cpf</td>
            <td>rg</td>
            <td>endereco</td>
            <td>telefone</td>
            <td>email</td>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['nome']; ?></td>
                <td><?php echo $user['cpf']; ?></td>
                <td><?php echo $user['rg']; ?></td>
                <td><?php echo $user['endereco']; ?></td>
                <td><?php echo $user['telefone']; ?></td>
                <td><?php echo $user['email']; ?></td>
            </tr>
        <?php endforeach; ?>


    </table>
</div>


<?php require_once '../views/footer.php'; ?>