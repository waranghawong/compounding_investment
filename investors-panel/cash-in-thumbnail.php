<?php 
  $image = '';

  foreach($data as $datas){

    switch ($datas['name']) {
        
    case "Gcash":
        $image = '../bank_images/gcash.png';
        break;
    case "Union Bank of the Philippines":
        $image = '../bank_images/union-bank.png';
        break;
    case "BDO":
        $image = '../bank_images/bdo.png';
        break;
    default:
    $image = '../bank_images/bank-logo.png';

    }
?>

<div class="col-md-55">
    <div class="thumbnail">
        <div class="image view view-first">
        <img style="width: 100%; display: block;" src="<?= $image ?>" alt="image" />
            <div class="mask">
               <p><?= $datas['name']; ?></p>
            </div>
       
        </div>
        <div class="caption">
          
            <p><?= $datas['account_name']; ?></p>
            <p><?= $datas['account_number']; ?></p>
        </div>
    </div>
</div>  
<?php
}
?>