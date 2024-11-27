<?php
require('./fpdf.php');
include '../ConexionSQL/conexion.php';

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      $this->Image('logo.png', 185, 5, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(50); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode('Software 4U'), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color

      /* UBICACION */
      $this->Cell(150);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, 10, utf8_decode("Ubicación : Santander De Quilichao"), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(150);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode("Teléfono : 3043159078"), 0, 0, '', 0);
      $this->Ln(5);

      /* COREEO */
      $this->Cell(150);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Correo : software_4u@gmail.com"), 0, 0, '', 0);
      $this->Ln(10);

      $this->SetTextColor(19, 79, 118);
      $this->Cell(90); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("REPORTE RESERVAS"), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(19, 79, 118); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(50, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
      $this->Cell(25, 10, utf8_decode('Cedula'), 1, 0, 'C', 1);
      $this->Cell(25, 10, utf8_decode('Nom Insumo'), 1, 0, 'C', 1);
      $this->Cell(80, 10, utf8_decode('Descripcion'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('Estado Insumo'), 1, 0, 'C', 1);
      $this->Cell(35, 10, utf8_decode('Fecha Inicio'), 1, 0, 'C', 1);
      $this->Cell(35, 10, utf8_decode('Fecha Entrega'), 1, 1, 'C', 1); 
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}
$sql = "SELECT u.nombre AS NombreUsuario, u.cedula AS CedulaUsuario, i.NomInsumo, i.Descripcion,
i.Estado AS EstadoInsumo, r.FechaInicio, r.FechaFin
FROM reservas r
JOIN usuarios u ON r.UsuarioID = u.id
JOIN insumos i ON r.InsumoID = i.id";

$pdf = new PDF();
$pdf->AddPage("landscape"); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 10);
$pdf->SetDrawColor(163, 163, 163);

$consulta_reporte_insumos = $conn->query($sql);

while ($datos_reporte = $consulta_reporte_insumos->fetch_object()) {
   // Aquí debes agregar código para procesar los datos y agregar celdas al PDF
   $pdf->Cell(50, 10, utf8_decode($datos_reporte->NombreUsuario), 1, 0, 'C', 0);
   $pdf->Cell(25, 10, utf8_decode($datos_reporte->CedulaUsuario), 1, 0, 'C', 0);
   $pdf->Cell(25, 10, utf8_decode($datos_reporte->NomInsumo), 1, 0, 'C', 0);
   $pdf->Cell(80, 10, utf8_decode($datos_reporte->Descripcion), 1, 0, 'C', 0);
   $pdf->Cell(30, 10, utf8_decode($datos_reporte->EstadoInsumo), 1, 0, 'C', 0);
   $pdf->Cell(35, 10, utf8_decode($datos_reporte->FechaInicio), 1, 0, 'C', 0);
   $pdf->Cell(35, 10, utf8_decode($datos_reporte->FechaFin), 1, 1, 'C', 0);
   $i++;
}

$pdf->Output('Prueba.pdf', 'I');
?>
