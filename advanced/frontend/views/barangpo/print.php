<?php
use app\models\Person;
use app\models\Barangpodetail;
$this->title="Print PO";



?>

<link rel='stylesheet' href='<?=\yii\helpers\Url::home()?>css/bootstrap.css'>
<style type="text/css">
	body
	{
		font-size: 10pt;
	}
	table, th, td {
	  border: 1px solid black;
	}
</style>

<div class="row" style="margin:0px !important;">
<div class="col-md-12">
	<h3 align="center">PT. GLOBAL SAHABAT OTOMASI</h3>
</div>   

<div class="row col-12">

<div class="col-sm-8 " style="padding-left: 50px;">
	<img src="<?=\yii\helpers\Url::home()?>images/logo_1.JPG">
</div>
<div class="col-sm-4" style="line-height:normal;padding-left: 50px;">
	Jl. Krekot Bunder Raya 11A RT : 004 RW : 06
	<br/>Pasar Baru Sawah Besar Jakarta Pusat 10710<br/>Telp : +62 21 21203773<br/>
	www.gso.asia

</div>

</div>

<div class="col-md-12">
	<h3 align="center"><u>PURCHASE ORDER</u></h3>
</div>   

<div class="row col-12">

	<div class="col-4" style="padding-left: 200px">
		<table class="" style="font-size: 10pt;">
			<tr>
				<td colspan="2" style="width:300px">TO :<br/>
					<?php echo "<b>".$model->perusahaan->nama .'</b><br/>'.$model->perusahaan->alamat?>

				</td>
			</tr>
			<tr>
				<td>Up</td>
				<td><?php $cel=Person::findOne(['id_costumer'=>$model->perusahaan->id]); 
					if(isset($cel)) echo $cel->nama;
					?></td>
			</tr>
			<tr>
				<td>Telp / Mobile</td>
				<td><?php if(isset($cel)) echo $cel->telp; ?></td>
			</tr>
			<tr>
				<td>Fax / Email</td>
				<td><?php if(isset($cel)) echo $cel->email; ?></td>
			</tr>
		</table>
	</div>
	<div class="col-4"></div>
	<div class="col-4">
		<table class="" style="font-size: 10pt;">
			<tr>
				<td>PO No.</td>
				<td style="width: 200px;"><?php  echo $model->kode;?></td>
			</tr>
			<tr>
				<td>Date</td>
				<td><?php  echo $model->tanggal;?></td>
			</tr>
			<tr>
				<td>Sales Name</td>
				<td><?php  echo $model->user->username;?></td>
			</tr>
			<tr>
				<td>Mobile</td>
				<td><?php  //echo $model->kode;?></td>
			</tr>
			<tr>
				<td>Payment</td>
				<td><?php  //echo $model->kode;?></td>
			</tr>
			<tr>
				<td>Term</td>
				<td><?php  //echo $model->kode;?></td>
			</tr>
			<tr>
				<td>Currency</td>
				<td>IDR</td>
			</tr>
			
		</table>
	</div>

</div>

<div class="col-md-12" style="margin-top:25px;">
	<table class="" style="font-size: 10pt;">
		<tr>
			<td style="text-align: center;"><b>No. </b></td>
			<td width="25%" style="text-align: center;"> <b>Part Number</b></td>
			<td width="30%" style="text-align: center;"><b>Description</b></td>
			<td style="text-align: center;"><b>Stock</b></td>
			<td colspan="2" style="text-align: center;"><b>Qty</b></td>
			<td width="12%" style="text-align: center;"><b>Unit Price</b></td>
			<td width="12%" style="text-align: center;"><b>Price</b></td>
		</tr>
		<?php 
			$podet=Barangpodetail::find()->where(['id_kode'=>$model->id])->all();
			$total=0;
			$i=1;
			foreach($podet as $val){
				$total1=$val->qty * $val->barang->harga;
				$total+=$total1;
		?>

		<tr>
			<td><?php echo $i ?></td>
			<td><?php echo $val->barang->kode?></td>
			<td><?php echo $val->barang->ukuran?></td>
			<td>indent</td>
			<td><?php echo $val->qty ?></td>
			<td>pcs</td>
			<td><?php echo number_format($val->barang->harga) ?></td>
			<td><?php echo number_format($total1) ?></td>
		</tr>

		<?php 
			$i++;}
		?>

		<tr>
			<td colspan="5" rowspan="3">Notes :<br/>
PO to: order@gso.asia<br/>
Pembayaran dilakukan dengan transfer ke Rek Mandiri 1200010055494 an PT.Global Sahabat Otomasi
<br/>50% DP
<br/>40% Goods Delivery
<br/>10% Afer Comissioning/BAP </td>
			<td colspan="2">Total</td>
			<td><?php number_format($total);$ppn=$total*0.11; ?></td>
		</tr>
		<tr>
			<td>Disc</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>PPN</td>
			<td>11%</td>
			<td><?php echo number_format($ppn);$total+=$ppn;?></td>
		</tr>
		<tr>
			<td colspan="6">Grand Total</td>
			<td>IDR</td>
			<td><?php echo number_format($total)?></td>
		</tr>
	</table>
</div>

<div class="col-md-12">
	<h5 align="center">	
PT Global Sahabat Otomasi “Your Automation Partner"</h5>
</div>
<div class="col-md-12">
Workshop : Jl. Kartni IV Dalam No. 029 RT 004 RW 004 Kel. Kartni Kec. Sawah Besar Jakarta Pusat Indonesia<br/>
Office : Jl. Krekot Bunder Raya 11A RT : 004 RW : 06 Kel. Pasar Baru Kec. Sawah Besar Jakarta Pusat 1071
</div>
</div>