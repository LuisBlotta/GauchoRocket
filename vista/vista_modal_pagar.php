<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="public/js/jquery.creditCardValidator.js"></script>

<div class="container">

  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Pago</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->  

        <div class="modal-body">
          <div class="payment">
            <?php
            echo "<form action='index.php?pag=cobrar&nro_reserva=".$dato['nro_reserva']."' method='post'>"
            ?>


            <!--5018 0000 0009-->
              <label>Número<input class="form-control" name="numero_tarjeta"></label>
                <p class="log"></p>

              <script>
                $(function() {
                  $('input').validateCreditCard(function(result) {
                    $('.log').html('<input style="border-style: none;" value=' + (result.card_type == null ? '-' : result.card_type.name)+' readonly><br>'
                      + '<input name="validez" style="border-style: none;" value=' + result.valid+' readonly>'
                      + '<br>Length valid: ' + result.length_valid
                      + '<br>Luhn valid: ' + result.luhn_valid);
                  });
                });
              </script>

                <button class="btn btn-info">Confirmar</button> 
            </form>
            
            
            <!--<form>
              <div class="form-group owner">
                <label for="owner">Nombre y Apellido</label>
                <input type="text" class="form-control" id="owner">
              </div>            
              <div class="form-group" id="card-number-field">
                <label for="cardNumber">Número</label>
                <input type="text" class="form-control" id="cardNumber">
              </div>
              <div class="form-group CVV">
                <label for="cvv">CVV</label>
                <input type="text" class="form-control" id="cvv">
              </div>
              <div class="form-group" id="expiration-date">
                <label>Fecha de Vencimiento</label>
                <span>
                  <select class="custom-select">
                    <option value="01">Enero</option>
                    <option value="02">Febrero </option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Augosto</option>
                    <option value="09">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Novimbre</option>
                    <option value="12">Diciembre</option>
                  </select>
                  <select class="custom-select">
                    <option value="16"> 2019</option>
                    <option value="17"> 2020</option>
                    <option value="18"> 2021</option>
                    <option value="19"> 2022</option>
                    <option value="20"> 2023</option>
                    <option value="21"> 2025</option>
                    <option value="21"> 2026</option>
                    <option value="21"> 2027</option>
                    <option value="21"> 2028</option>
                    <option value="21"> 2029</option>
                    <option value="21"> 2030</option>
                    <option value="21"> 2031</option>
                    <option value="21"> 2032</option>
                    <option value="21"> 2033</option>
                    <option value="21"> 2034</option>
                  </select>
                </span>
              </div>
              <div class="form-group" id="credit_cards">
                <img src="assets/images/visa.jpg" id="visa">
                <img src="assets/images/mastercard.jpg" id="mastercard">
                <img src="assets/images/amex.jpg" id="amex">
              </div>
              <div class="form-group" id="pay-now">
                <button class="btn btn-info" id="confirm-purchase">Confirm</button>
              </div>
            </form>-->
          </div>

          
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div>

      </div>
    </div>
  </div>  
</div>