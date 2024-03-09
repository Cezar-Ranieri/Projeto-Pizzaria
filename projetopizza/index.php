<?php
    include('componentes/header.php');
    include('database/queries.php');

    session_start();
    $msg = '';
    if(isset($_SESSION['status'])){
        $msg = $_SESSION['status'];
        $class = $_SESSION['class'];
        unset($_SESSION['status']);
    };

    if(isset($_POST['submit']))
        if(!empty($_POST['massa']) && !empty($_POST['borda']) && !empty($_POST['sabores']) && count($_POST['sabores']) < 4){
            $massainsert = $_POST['massa'];
            $bordainsert = $_POST['borda'];
            $saboresinsert = $_POST['sabores'];

            $result = mysqli_query($conn, "INSERT INTO pizzas (borda_id, massa_id) VALUES ('$bordainsert', '$massainsert')");

            $lastidquery = mysqli_query($conn, "SELECT LAST_INSERT_ID()");
            $lastid = mysqli_fetch_assoc($lastidquery)['LAST_INSERT_ID()'];
            print_r($lastid);

            foreach($saboresinsert as $saborinsert){
                $resultsabores = mysqli_query($conn, "INSERT INTO pizza_sabor (pizza_id, sabor_id) VALUES ('$lastid', '$saborinsert')");  
            }
            
            $_SESSION['status'] = 'Pedido enviado com sucesso!';
            $_SESSION['class'] = 'sucesso';
            header('location: index.php');
        } else {
            $_SESSION['status'] = 'Erro! Preencha os dados corretamente.';
            $_SESSION['class'] = 'erro';
            header('location: index.php');
        }
            
?>
        <h2 id="<?= $class?>"><?= $msg ?></h2>
    <div id="background">
        <p>Monte sua pizza</p>
    </div>
    <main>
        <form action="index.php" method="POST">
            <label for="massa">Escolha a massa:</label>
            <select name="massa" id="massa">
            <option disabled selected value> -- Escolha uma opção: -- </option>
                <?php foreach($massas as $massa): ?>
                    <option value="<?=$massa['id']?>"><?=$massa['tipo']?></option>
                <?php endforeach; ?>
            </select>
            <label for="borda">Escolha a borda  :</label>
            <select name="borda" id="borda">
                <option disabled selected value> -- Escolha uma opção: -- </option>
                <?php foreach($bordas as $borda): ?>
                    <option value="<?=$borda['id']?>"><?=$borda['tipo']?></option>
                <?php endforeach; ?>
            </select>
            <label for="sabores">Escolha os sabores: (Maximo: 3)</label>
            <select multiple name="sabores[]" id="sabores">
                <?php foreach($sabores as $sabor): ?>
                    <option value="<?=$sabor['id']?>"><?=$sabor['nome']?></option>
                <?php endforeach; ?> 
            </select>
            <input type="submit" name='submit' value="Enviar pedido" id="inputsubmit">
        </form>
    </main>

<?php
    include('componentes/footer.php')
?>