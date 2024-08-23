    <style>
        /* Estilo geral do formulário */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .form-group {
            flex: 1;
            min-width: 30%;
            margin-right: 15px;
        }

        .form-group:last-child {
            margin-right: 0;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px 20px;
        }

        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Responsividade para telas menores */
        @media (max-width: 768px) {
            .form-group {
                flex: 100%;
                min-width: 100%;
                margin-right: 0;
            }
        }
    </style>

    <?php require_once '../views/header.php'; ?>

    <div class="form-container">
        <?php if (isset($result) && !empty($result)) {
            echo "<p style='color: green;'>{$result}</p>";
        }
        ?>
        <form action="#" method="POST">
            <span>Dados Responsavel</span>

            <div class="form-row">
                <div class="form-group">
                    <label for="nome">Nome Completo</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" name="cpf" onchange="checaCPF()" required>
                    <label name="resultado" id="resultado" hidden></label>
                </div>
                <div class="form-group">
                    <label for="rg">RG</label>
                    <input type="text" id="rg" name="rg" required>
                </div>
                <div class="form-group">
                    <label for="apelido">Apelido</label>
                    <input type="text" id="apelido" name="apelido" required>
                </div>
            </div>

            <span>Contatos</span>
            <div class="form-row">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="tel" id="telefone" name="telefone" required>
                </div>

            </div>

            <span>Endereço</span>
            <div class="form-row">
                <div class="form-group">
                    <label for="logradouro">Endereço</label>
                    <input type="text" id="logradouro" name="logradouro" required>
                </div>
                <div class="form-group">
                    <label for="numero">Numero</label>
                    <input type="text" id="numero" name="numero" required>
                </div>
                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input type="text" id="cidade" name="cidade" required>
                </div>
                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <input type="text" id="bairro" name="bairro" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="complemento">Complemento</label>
                    <input type="text" id="complemento" name="complemento">
                </div>
                <div class="form-group">
                    <label for="uf">Estado</label>
                    <select id="uf" name="uf" required>
                        <option value="">Selecione o estado</option>
                        <option value="sp">São Paulo</option>
                        <option value="rj">Rio de Janeiro</option>
                        <option value="mg">Minas Gerais</option>
                        <option value="es">Espírito Santo</option>
                        <!-- Adicione mais estados conforme necessário -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="cep">CEP</label>
                    <input type="text" id="cep" name="cep" required>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" value="Enviar">
            </div>
        </form>
    </div>


    <?php require_once '../views/footer.php'; ?>

    <script>
        function checaCPF() {
            var cpf = document.getElementById('cpf').value;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/AdminCad/public/index.php/validaCpf', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.valid) {
                        resultado.hidden = true;
                        resultado.innerText = '';
                    } else {
                        resultado.hidden = false;
                        resultado.innerText = 'CPF inválido';
                        resultado.style.color = 'red';
                    }
                }
            };

            xhr.send('cpf=' + cpf);
        }
    </script>