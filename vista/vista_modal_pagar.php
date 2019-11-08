<link rel="stylesheet" type="text/css" href="public/css/estilos-modal_pagar.css">

<div class="container">

  <!-- The Modal -->
    <?php echo"<div class='modal' id='myModal".$reserva['nro_reserva']."'>" ?>
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Resumen</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?php echo "                
                    <p>N° de reserva: " . $reserva['nro_reserva'] . "</p>
                    <h2>" . $reserva['destino'] . "</h2>
                    <p>Origen: " . $reserva['origen'] . "</p><br>
    
                    <p>
                        <span>
                        <img src='public/img/calendar.png'> ".$reserva['fecha_ida']."
                        </span>
                        <span class='hora-modal'>
                            <img src='public/img/clock.png'> " . $reserva['hora_partida'] . ":00
                        </span>
                    </p><br>
                    
                    <p>Cantidad de pasajeros: " . $reserva['cantidad_lugares'] . "</p>   
                    <p>Precio unitario: $".$reserva['precio'].".-</p>    
                    <h3>Total: $" . $reserva['precio_total'] . ".-</h3><br>";
                ?>
            </div>
                <div class="modal-header">
                    <h4 class="modal-title">Pago</h4>
                </div>
            <!-- Modal body -->
                    <div class="payment">
                    <?php
                    echo "<form action='cobrar?nro_reserva=".$reserva['nro_reserva']."' method='post' id='form-pago'>"
                    ?>
                        <div class="modal-body">
                            <div class="form-group" id="card-number-field">
                                <div class="cont-numero-cvv">

                                    <div class="cont-number">
                                        <label for="cardNumber">Número</label>
                                        <div class="cont-card-number">
                                            <div class="input-group-prepend">
                                                <p id="visa">Visa</p>
                                                <p id="mastercard">Mastercard</p>
                                                <p id="amex">Amex</p>
                                            </div>
                                            <input type="text" class="form-control" id="cardNumber" name="numero_tarjeta">
                                        </div>
                                        <div id="validez-numero"></div>
                                    </div>

                                    <div class="cont-cvv">
                                        <label for="cvv">CVV</label>
                                        <input type="text" class="form-control" id="cvv" name="cvv">
                                        <div id="validez-cvv"></div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group owner">
                                <label for="owner">Nombre y Apellido</label>
                                <input type="text" class="form-control" id="owner" name="nombre">
                                <div id="validez-nombre"></div>
                            </div>

                            <div class="form-group" id="expiration-date">
                                <label>Fecha de Vencimiento</label>
                                    <div class="input-fecha">
                                        <input type="text" class="form-control" id="expiry" name="vencimiento">
                                        <div id="validez-fecha"></div>
                                        <div id="mes"></div>
                                        <div id="año"></div>
                                    </div>
                            </div>
                            <div class="form-group" id="credit_cards">
                                <p id="visa">Visa</p>
                                <p id="mastercard">Mastercard</p>
                                <p id="amex">Amex</p>


                                <!--<img src="public/img/visa.jpg" id="visa">
                                <img src="public/img/mastercard.jpg" id="mastercard">
                                <img src="public/img/amex.jpg" id="amex">-->
                            </div>
                        </div>
                        <div class="modal-footer" id="pay-now">
                            <button type="submit" class="btn btn-info" id="confirm-purchase">Confirmar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                <script src="public/js/jquery.payform.min.js" charset="utf-8"></script>
                <script src="public/js/script_validacion_tarjeta.js"></script>
            </div>
        </div>
    </div>
</div>