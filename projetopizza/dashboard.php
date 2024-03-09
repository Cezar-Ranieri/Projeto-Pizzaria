<?php
    include('componentes/header.php');
    include('database/queries.php');
    
    if (isset($_POST['deleteid'])){
        $delid = $_POST['deleteid'];
        mysqli_query($conn, "DELETE FROM pizza_sabor WHERE pizza_id = '$delid'");
        mysqli_query($conn, "DELETE FROM pizzas WHERE id = '$delid'");
        header('location: dashboard.php');
    }
?>

<div id="containerdashboard">
    <h2 id='dashboardtitulo'>Lista de pedidos</h2>
    <main id="dashboard">
        <table>
            <tr>
                <th>ID</th>
                <th>Massa</th>
                <th>Borda</th>
                <th>Sabores</th>
                <th>Ações</th>
            </tr>
    
            <?php foreach($pizzas as $pizza): ?>
                <?php
                    $bordaid = $pizza['borda_id'];
                    $querybordapizza = mysqli_query($conn, "SELECT tipo FROM bordas WHERE id = '$bordaid'");
                    $bordapizza = mysqli_fetch_assoc($querybordapizza);
    
                    $massaid = $pizza['massa_id'];
                    $querymassapizza = mysqli_query($conn, "SELECT tipo FROM massas WHERE id = '$massaid'");
                    $massapizza = mysqli_fetch_assoc($querymassapizza);
    
                    $pizzaid = $pizza['id'];
                    $querysaboresid = mysqli_query($conn, "SELECT sabor_id FROM pizza_sabor WHERE pizza_id = '$pizzaid'");
                    $saboresid = mysqli_fetch_all($querysaboresid, MYSQLI_ASSOC);
    
                    $saborarray = [];
    
                    foreach($saboresid as $saborid){
                        $saborvar = $saborid['sabor_id'];
                        $querysaborespizza = mysqli_query($conn, "SELECT nome FROM sabores WHERE id = '$saborvar'");
                        $saborespizza = mysqli_fetch_all($querysaborespizza, MYSQLI_ASSOC);
                        foreach($saborespizza as $saborpizza){
                            array_push($saborarray, $saborpizza['nome']);
                        }
                    };
                ?>
    
                <tr>
                    <td><?= $pizza['id'] ?></td>
                    <td><?= $massapizza['tipo'] ?></td>
                    <td><?= $bordapizza['tipo'] ?></td>
                    <td><?php foreach($saborarray as $sabor){echo $sabor . '<br/> ';} ?></td>
                    <td>
                        <form action="" class='delete' method='POST'>
                            <input type="hidden" name="deleteid" value="<?=$pizza['id']?>">
                            <input type="submit" value="Deletar" class='submitdelete'>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
    
        </table>
    </main>
</div>

<?php 
    include('componentes/footer.php')
?>