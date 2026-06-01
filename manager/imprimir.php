
<style type="text/css">
  * {
    font-size: 12px;
    font-family: 'Times New Roman';
  }

  td,
  th,
  tr,
  table {
    border-top: 1px solid black;
    border-collapse: collapse;
  }

  td.producto,
  th.producto {
    width: 95px;
    max-width: 95px;
  }

  td.cantidad,
  th.cantidad {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
  }

  td.precio,
  th.precio {
    width: 70px;
    max-width: 70px;
    word-break: break-all;
    text-align: center;
    align-content: center;
  }

  .centrado {
    text-align: center;
    align-content: center;
  }

  .ticket {
    width: 195px;
    max-width: 195px;
  }

  .ticket2 {
    width: 100px;
    max-width: 100px;
  }

  img {
    width: 100px;
  }

  @media print {
    .oculto-impresion,
    .oculto-impresion * {
      display: none !important;
    }
  }
</style>

<!DOCTYPE html>
<html>
<body>
  <div class="ticket">

    <?php
    require("../conexion/conexion.php");
    $configuracion="SELECT logo, color, marca, titulo FROM configuracion ";
    $config=mysqli_query($mysqli,$configuracion);
    while ($conf=mysqli_fetch_row ($config)){
      $logo=$conf[0];
      $color=$conf[1];
      $marca=$conf[2];
      $titulo=$conf[3];
    }
    ?>

    <p class="centrado" style="margin-left: -20px;">
      <img src="../assets/img/logo/<?php echo $logo ?>" alt="Logotipo">
    </p>

    <p class="centrado" style="margin-left: -20px;"><?php echo $marca ?> S.A
      <br>Tu Veterinaria Online
      <br><?php echo date('d/m/Y'); ?> <?php echo date('H:i:s A'); ?></p>
      <table>
        <thead>
          <tr>
            <th class="producto">PRODUCTO</th>
            <th class="precio">PRECIO</th>
          </tr>
        </thead>
        <tbody>

          <?php

          require("../conexion/conexion.php");
          $id_vent=$_GET['id'];
          $ventas_detalle_="SELECT * FROM ventas_detalle WHERE id_venta='$id_vent' and estado='0' ORDER BY id_venta_detalle DESC ";
          $ventas_detalle=mysqli_query($mysqli,$ventas_detalle_);
          while ($ventas_detail=mysqli_fetch_row ($ventas_detalle)){

            $id_venta_detalle = $ventas_detail[0];
            $id_venta = $ventas_detail[1];
            $id_usuario = $ventas_detail[2];
            $id_inventario = $ventas_detail[3];
            $precio = $ventas_detail[4];
            $cantidad = $ventas_detail[5];
            $total = $ventas_detail[6];
            $fecha_registro = $ventas_detail[7];
            $estado = $ventas_detail[8];


          //DATOS
            $inventarios_="SELECT nombre_articulo FROM inventario WHERE id_inventario='$id_inventario'";
            $inventario=mysqli_query($mysqli,$inventarios_);
            while ($invent_info=mysqli_fetch_row ($inventario)){
              $nombre=$invent_info[0];
            }
          //DATOS


          //TOTAL
            $inventariostotal_="SELECT total, cod FROM ventas WHERE id_venta='$id_venta'";
            $inventariototal=mysqli_query($mysqli,$inventariostotal_);
            while ($inventtotal_info=mysqli_fetch_row ($inventariototal)){
              $total_de_la_venta=$inventtotal_info[0];
              $fecha_cod=$inventtotal_info[1];
            }
          //TOTAL

            echo 
            '
            <tr>
            <td class="producto">'.$nombre.' <b> x '.$cantidad.'</b></td>
            <td class="precio"> $'.number_format($total).'</td>
            </tr>  
            ';

          }

          ?>
          <tr>
            <td class="producto"><p style='margin-top:5px;'>SUBTOTAL :</p></td>
            <td class="precio"><?php echo "<p style='margin-top:5px;'>$".number_format($total_de_la_venta)."</p>" ?></td>
          </tr>

          <tr>
            <td class="producto"><br><b>EXENTO :</b></td>
            <td class="precio"><br> 0</td>
          </tr> 
          <tr>
            <td class="producto"><br><b>GRAVADO :</b></td>
            <td class="precio"><br> <?php echo "$".number_format($total_de_la_venta) ?></td>
          </tr>
          <tr>
            <td class="producto"><br><b>EXONERADO:</b></td>
            <td class="precio"><br> 0</td>
          </tr>
          <tr>
            <td class="producto"><br><b>TOTAL :</b></td>
            <td class="precio"><br> <?php echo "$".number_format($total_de_la_venta) ?></td>
          </tr>
        </tbody>
      </table>

      <br>
      <p class="centrado" style="margin-left: -20px;">
        <img style="text-align:center;" src="https://barcode.tec-it.com/barcode.ashx?data=<?php echo $fecha_cod?>&code=Code128&dpi=96&dataseparator=" width="100%">
      </p>

      
      <p class="centrado" style="margin-left: -20px;">
        Version: 1.0
        <br>
        ¡GRACIAS POR SU COMPRA!
        <br><?php echo $marca ?></p>
      </div>


      <script type="text/javascript">
          window.print();
      </script>

    </body>
    </html>