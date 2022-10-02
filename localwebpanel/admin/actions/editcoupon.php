<?php
include '../../resources/functions.php';
$Coupon_id = $_POST['id'];
$sql = query("SELECT * FROM posrev.admin_coupon WHERE ID = $Coupon_id");
confirm($sql);
$row = fetch_array($sql);

$Couponname_     = $row['Couponname_']; 
$Desc_           = $row['Desc_'];
$Discountvalue_  = $row['Discountvalue_'];
$Referencevalue_ = $row['Referencevalue_'];
$Type            = $row['Type'];
$Bundlebase_     = $row['Bundlebase_'];
$BBValue_        = $row['BBValue_'];
$Bundlepromo_    = $row['Bundlepromo_'];
$BPValue_        = $row['BPValue_'];
$Effectivedate   = $row['Effectivedate'];
$Expirydate      = $row['Expirydate'];
$date_created    = $row['date_created'];

?>
<h5>Please do not fill the empty input boxes</h5>
<input type="hidden" name="couponid" value="<?php echo $Coupon_id; ?>">
<div class="row">
  <div class="col-md-6">
    <label for="coupontype">Type</label>
    <div class="form-group">
       <select class="custom-select" name="coupontype">  
        <?php
        if ($Type == "Percentage(w/o vat)") {
          echo '<option value="'.$Type.'">'.$Type.'</option>
          <option value="Percentage(w/ vat)">Percentage(w/ vat)</option>
          <option value="Fix-1">Select Coupon Type</option>
          <option value="Fix-2">Fix-2</option>
          <option value="Bundle-1(Fix)">Bundle-1(Fix)</option>
          <option value="Bundle-2(Fix)">Bundle-2(Fix)</option>
          <option value="Bundle-3(%)">Bundle-3(%)</option>';
        } elseif ($Type == "Percentage(w/ vat)") {
          echo '<option value="'.$Type.'">'.$Type.'</option>
          <option value="Percentage(w/o vat)">Percentage(w/o vat)</option>
          <option value="Fix-1">Select Coupon Type</option>
          <option value="Fix-2">Fix-2</option>
          <option value="Bundle-1(Fix)">Bundle-1(Fix)</option>
          <option value="Bundle-2(Fix)">Bundle-2(Fix)</option>
          <option value="Bundle-3(%)">Bundle-3(%)</option>';
        } elseif ($Type == "Fix-1") {
          echo '<option value="'.$Type.'">'.$Type.'</option>
          <option value="Percentage(w/o vat)">Percentage(w/o vat)</option>
          <option value="Percentage(w/ vat)">Percentage(w/ vat)</option>
          <option value="Fix-2">Fix-2</option>
          <option value="Bundle-1(Fix)">Bundle-1(Fix)</option>
          <option value="Bundle-2(Fix)">Bundle-2(Fix)</option>
          <option value="Bundle-3(%)">Bundle-3(%)</option>';
        } elseif ($Type == "Fix-2") {
          echo '<option value="'.$Type.'">'.$Type.'</option>
          <option value="Percentage(w/o vat)">Percentage(w/o vat)</option>
          <option value="Percentage(w/ vat)">Percentage(w/ vat)</option>
          <option value="Fix-1">Fix-1</option>
          <option value="Bundle-1(Fix)">Bundle-1(Fix)</option>
          <option value="Bundle-2(Fix)">Bundle-2(Fix)</option>
          <option value="Bundle-3(%)">Bundle-3(%)</option>';
        } elseif ($Type == "Bundle-1(Fix)") {
          echo '<option value="'.$Type.'">'.$Type.'</option>
          <option value="Percentage(w/o vat)">Percentage(w/o vat)</option>
          <option value="Percentage(w/ vat)">Percentage(w/ vat)</option>
          <option value="Fix-1">Fix-1</option>
          <option value="Fix-2">Fix-2</option>
          <option value="Bundle-2(Fix)">Bundle-2(Fix)</option>
          <option value="Bundle-3(%)">Bundle-3(%)</option>';
        } elseif ($Type == "Bundle-2(Fix)") {
          echo '<option value="'.$Type.'">'.$Type.'</option>
          <option value="Percentage(w/o vat)">Percentage(w/o vat)</option>
          <option value="Percentage(w/ vat)">Percentage(w/ vat)</option>
          <option value="Fix-1">Fix-1</option>
          <option value="Fix-2">Fix-2</option>
          <option value="Bundle-1(Fix)">Bundle-1(Fix)</option>
          <option value="Bundle-3(%)">Bundle-3(%)</option>';
        } elseif ($Type == "Bundle-3(%)") {
          echo '<option value="'.$Type.'">'.$Type.'</option>
          <option value="Percentage(w/o vat)">Percentage(w/o vat)</option>
          <option value="Percentage(w/ vat)">Percentage(w/ vat)</option>
          <option value="Fix-1">Fix-1</option>
          <option value="Fix-2">Fix-2</option>
          <option value="Bundle-1(Fix)">Bundle-1(Fix)</option>
          <option value="Bundle-2(Fix)">Bundle-2(Fix)</option>';
        }
        ?>

       </select>
    </div> 
    <label for="couponname">Coupon Name</label>
    <div class="form-group">
      <input type="text" class="form-control" name="couponname" value="<?php echo $Couponname_;?>">  
    </div> 
    <label for="coupondesc">Coupon Description</label>
    <div class="form-group">
      <textarea style="height: 124px;" class="form-control" name="coupondesc" value><?php echo $Desc_;?></textarea>  
    </div> 
    <label for="discoutvalue">Discount Value</label>
    <div class="form-group">
      <input type="text" class="form-control" name="discoutvalue" value="<?php echo $Discountvalue_;?>">  
    </div> 
    <label for="referencevalue">Reference Value</label>
    <div class="form-group">
      <input type="text" class="form-control" name="referencevalue" value="<?php echo $Referencevalue_;?>">  
    </div>
  </div>
  <div class="col-md-6">
      <label for="bundlebase">Bundle Base</label>
    <div class="form-group">
      <input type="text" class="form-control" name="bundlebase" value="<?php echo $Bundlebase_;?>">  
    </div>

    <label for="bundlebasevalue">Bundle Base Value</label>
    <div class="form-group">
      <input type="text" class="form-control" name="bundlebasevalue" value="<?php echo $BBValue_;?>">  
    </div>
    <label for="bundlepromo">Bundle Promo</label>
    <div class="form-group">
      <input type="text" class="form-control" name="bundlepromo" value="<?php echo $Bundlepromo_;?>">  
    </div>
    <label for="bundlepromovalue">Bundle Promo Value</label>
    <div class="form-group">
      <input type="text" class="form-control"  name="bundlepromovalue" value="<?php echo $BPValue_;?>">  
    </div>
      <label for="effectivedate">Effective Date</label>
    <div class="form-group">
      <input type="text" class="form-control" name="effectivedate" value="<?php echo $Effectivedate;?>">  
    </div>
      <label for="expirydate">Expiry Date</label>
    <div class="form-group">
      <input type="text" class="form-control" name="expirydate" value="<?php echo $Expirydate;?>">  
    </div>
  </div>
</div>