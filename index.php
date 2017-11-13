<?php
$arrayvalue=$_POST;
$count=count($arrayvalue);
$i=$count - 5;


$style= '<style type="text/css">
        table{
        width:calc(100%/' . $i .');
        }';

$array=array("yearly","monthly","four-weekly","two-weekly","weekly","daily");
foreach($array as $item){
    if(isset($_POST[$item])){
    $style = $style . '#'.$item.'{
        display:table;
    }'; 
        //echo $item;
    }    
}
$style = $style.'</style>';
echo $style;
//calculation

/**$mon=$_POST[monthly];
echo $mon;
$over=$_POST[overtime];
echo $over;
$sta=$_POST[status];
echo $sta;
$dep=$_POST[dependents];
echo $dep;
$dedu=$_POST[deduction];
echo $dedu;**/

$sal=0;
$mon=0;
$over=0;
$sta="";
$dep=0;
$dedu=0;
if(! empty($_POST['salary'])){
  $sal=$_POST['salary'];
}
if(! empty($_POST['Monthly'])){
  $mon=$_POST['Monthly'];
}
if(! empty($_POST['overtime'])){
  $over=$_POST['overtime']; 
}
if(! empty($_POST['status'])){
  $sta=$_POST['status'];  
}
if(! empty($_POST['dependents'])){
  $dep=$_POST['dependents'];  
}
if(! empty($_POST['deduction'])){
  $dedu=$_POST['deduction'];  
}

$hour=$sal/(52*40);
$onh=$mon*1.5*12*$hour;
$doub=$over*2*12*$hour;
$Grossincome=$sal+$onh+$doub;
$Deduction=0;
$Taxableincome=0;
$FT=0;
$Est=0;
$TK=0;
$l1=$l2=$l3=$l4=$l5=$l6=0;
if($sta == "Single")
{
    $l1=9325;
    $l2=37950;
    $l3=91900;
    $l4=191650;
    $l5=416700;
    $l6=418400;
    $ST=15773;
    $Deduction=($dep*4050)+($dedu*12);
    if($Grossincome>0){
        $Taxableincome=$Grossincome-10400-$Deduction;
    }
}
elseif($sta == "Married joint")
{
    $l1=18650;
    $l2=75900;
    $l3=153100;
    $l4=233350;
    $l5=416700;
    $l6=470700;
    $ST=15773;
    $Deduction=($dep*4050)+($dedu*12);
    if($Grossincome>0){
        $Taxableincome=$Grossincome-20800-$Deduction;
    }
}
elseif($sta == "Married seperately")
{
    $l1=9325;
    $l2=37950;
    $l3=76550;
    $l4=116675;
    $l5=208350;
    $l6=235350;
    $ST=15773;
    $Deduction=($dep*4050)+($dedu*12);
    if($Grossincome>0){
        $Taxableincome=$Grossincome-10400-$Deduction;
    }
}
elseif($sta == "Head of house")
{
    $l1=13350;
    $l2=50800;
    $l3=131200;
    $l4=212500;
    $l5=416700;
    $l6=235350;
    $ST=444550;
    $Deduction=($dep*4050)+($dedu*12);
    if($Grossincome>0){
        $Taxableincome=$Grossincome-13400-$Deduction;
    }
}

    $Med=$Grossincome*0.029;
    
    if($Taxableincome>0){
        if(($Grossincome>$l1)&&($Grossincome<=$l2)){
            $TT=$Taxableincome-$l1;
            $FT=($TT>0) ? (($l1*0.1)+($TT*0.15)) : (($l1+$TT)*0.1);
        }
        elseif($Grossincome>$l2 && $Grossincome<=$l3){
            $TT=$Taxableincome-$l2;
            $FT= ($TT>0) ? (($l1*0.1)+(($l2-$l1)*0.15)+($TT*0.25)) : (($l1*0.1)+(($l2-$l1+$TT)*0.15));
        }
        elseif($Grossincome>$l3 && $Grossincome<=$l4){
            $TT=$Taxableincome-$l3;
            $FT= ($TT>0) ? (($l1*0.1)+(($l2-$l1)*0.15)+(($l3-$l2)*0.25)+($TT*0.28)) : (($l1*0.1)+(($l2-$l1)*0.15)+(($l3-$l2+$TT)*0.25));
        }
        elseif($Grossincome>$l4 && $Grossincome<=$l5){
            $TT=$Taxableincome-$l4;
            $FT=($TT>0) ? (($l1*0.1)+(($l2-$l1)*0.15)+(($l3-$l2)*0.25)+(($l4-$l3)*0.28)+($TT*0.33)) : (($l1*0.1)+(($l2-$l1)*0.15)+(($l3-$l2)*0.25)+(($l4-$l3+$TT)*0.28));
        }
        elseif($Grossincome>$l5 && $Grossincome<=$l6){
            $TT=$Taxableincome-$l5;
            $FT=($TT>0) ? (($l1*0.1)+(($l2-$l1)*0.15)+(($l3-$l2)*0.25)+(($l4-$l3)*0.28)+(($l5-$l4)*0.33)+($TT*0.35)) : (($l1*0.1)+(($l2-$l1)*0.15)+(($l3-$l2)*0.25)+(($l4-$l3)*0.28)+(($l5-$l4+$TT)*0.33));
        }
        elseif($Grossincome>$l6){
            $TT=$Taxableincome-$l6;
            $FT=($TT>0) ? (($l1*0.1)+(($l2-$l1)*0.15)+(($l3-$l2)*0.25)+(($l4-$l3)*0.28)+(($l5-$l4)*0.33)+(($l6-$l5)*0.35)+($TT*0.396)) : (($l1*0.1)+(($l2-$l1)*0.15)+(($l3-$l2)*0.25)+(($l4-$l3)*0.28)+(($l5-$l4)*0.33)+(($l6-$l5+$TT)*0.35));
        }
        
    }
    else{
        $Taxableincome=0;
    }
    if($Grossincome<=127200){
        $ST=$Grossincome*0.124;
    }
    $Est=($ST+$Med)/2;
    $TK=$Grossincome-$FT-$Est-$Deduction;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!--<link rel="stylesheet" type="text/css" href="Test.css">-->
</head>
<style type="text/css">
     *{
    box-sizing: border-box;
    margin: 0px;
    padding: 0px;  
    
}
body{
    background-color:white;
    
}
header{
    height:15vh;
    width:80vw;
    margin:0 auto;
    background-color:azure;
    border:1px solid #257DCF;
    /**flex-wrap: wrap;
    overflow:hidden;**/
    
    
}
/** Header <h1> tag properties**/
#main-heading{
    position:absolute;
    padding-top:30px;
    padding-left: 10px;
    color:#257DCF;
    display: inline;
}
img{
    float:left;
    padding-top:10px;
    padding-left:10px;
    
}
nav{
    height:4vh;
    width:80vw;
    margin: 0 auto;
    background-color: azure;
    border:1px solid #257DCF;
    
    
}
/**nav a:first-child{
    padding-left:5px !important;
    
}**/
nav a{
    /**height:30px;
    width:25px;
    position:relative;
    padding-top:10px;
    margin-left:-5px;**/
    
    width:150px;
    height:22px;
    display:inline-block;
    position: relative;
    font-size:20px;
    text-decoration: none;
    
    padding-left:5px;
    margin-right: -4px;
    text-align: center;
    color:#257DCF;
    
    
}
nav a:hover{
    background-color: white;
}
#main-content{
        height:47vh;
        width: 80vw;
        background-color:white;
        margin:0 auto;
        padding-left:10px;
        color:#257DCF;
        border:1px solid #257DCF;
    padding-bottom: 5px;
}
/**#content1{
        width:100%;
        height:20%;
        margin:0 auto;
        padding:5px;
        background-color: burlywood;
}**/
#calculator{
        border: 1px solid #257DCF;
        float:left;
        width:27%;
        height:78%;
        
        padding:5px;
        margin-top:5px;
        
      
        
    }
    #heading-calc{
        background-color:azure;
    }
    
   /**.big-box{
        width:50px;
    }**/
    /**.small-box{
        width:30px;
        display: inline;
    }**/
  
   
/** changing the design of calculator's input types**/
    
    .question-mark{
       /** position:relative;
        left:250px;**/
        display:inline;
    }
/**.bigtext-box{
    width:130px;
    float: right;
    position:relative;
    
    
    
}
.smalltext-box{
    width:40px;
    
}
.align-right{
   
    position: relative;
    left:80px;
    
    
   
}
.span-align{
    position: relative;
    left:146px;
    
}
.span-align1{
   position: relative;
    left:143px; 
   
    
}
.span-align2{
    position:relative;
    right:-111px;
}
.span-align3{
    position:relative;
    right:-108px;
}
.span-right{
    position:relative;
    right:-20px;
}**/
.at-class{
    
    display: inline;
}

    
/** second section content design**/
   .content2{
        width:73%;
        height:78%;
        float:right;
        padding:5px;
       display: inline;
       overflow: scroll;
       
       
        
    }
    h2{
        background-color: azure;
    }
     #main-content-second{
        border: 1px solid #257DCF; 
        width:80vw;
        height:34vh;
         margin: 0 auto;
         background-color:azure;
         color:#257DCF;
         /**padding:5px;**/
    }
    /**#content3{
        color:#257DCF;
        border: 1px solid #257DCF;
         width:80vw;
        height:7vh;
        margin:0 auto;
        background-color: azure;
        float:left;
        padding:5px;
        text-align: center;
        padding-top: 15px;
    }**/
    #main-table{
        display: inline;
    }
    
   /** form  { display: table;
        
    }
p     { display: table-row;
    }
label { display: table-cell; }
input { display: table-cell; 
    }
    select{
        display:table-cell;
    }**/
    #checkbox-form{
        padding-left:5px;
    }

    table{
        height:88%;
        table-layout: fixed;
        color:#257DCF;
        overflow:hidden;
        float:left;
       display:none;
        /**border-collapse:collapse;**/
        border-top: 1px solid #257DCF;
        border-bottom: 1px solid #257DCF;
        
       
        /**display: inline;**/
        /**width:33.33%;**/
    }
    
    
   
 tr:nth-child(even) {
    background-color: white;
      width:100%;
      
}
    #default{
            display: table;
        }
    input[type="number"] {
    
    width:40%;
}
    
   /** #footer{
        position:relative;
        top:140px;
        width:80vw;
        height:60px;
        margin: 0 auto;
        border-top: 1px solid #257DCF;
        border-bottom: 1px solid #257DCF;
        background-color: white;
        text-align: center;
    }**/
    #log{
         position: relative;
    display: inline-block;
  

    }
   #hover {
  visibility: hidden;
    width: 120px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;

    /* Position the tooltip */
    position: absolute;
    z-index: 1;
}
    </style>

<body>
<header>
     
      <img src="Money-in-hand.png">
      <h1 id="main-heading">Tax Calculation</h1>
       
    
   </header>
   <nav>
        <a href="index.php">Take Home</a> 
        <a href="index.php">Hourly Wage</a>
        <a href="index.php">About</a> 

   </nav>
   <article id="main-content">
   
  <h1 >Us Income Tax Calculator 2017</h1>
  <p>The Tax Calculator uses tax information from the tax year 2017 to show you take-home pay. See where that hard-earned money goes - with Federal Income Tax, Social Security, and other deductions. More information about the calculations performed is available on the about page.

</p>
  
   <section id="calculator">
   <h1 id="heading-calc">Calculator</h1>
   
    <form method="post">
		<p>
            <label>salary $</label>
			<input class="big-box" type="number" name="salary" value="<?php echo isset($_POST['salary']) ? $_POST['salary'] : 0; ?>" />
		</p>
		<p>
			<label>monthly</label>
			<input class="big-box" type="number" value="0" name="Monthly" value="<?php echo isset($_POST['Monthly']) ? $_POST['Monthly'] : 0; ?>" />&#64; 1.5 
		</p>
		<p><label>overtime</label>
			<input class="big-box" type="number" value="0" name="overtime" value="<?php echo isset($_POST['overtime']) ? $_POST['overtime'] : 0; ?>" />&#64; 2 
        <p><label>Filling status</label><select name="status" value="<?php echo isset($_POST['status']) ? $_POST['status'] : Single; ?>">
           <option value="Single" >Single</option>
            <option value="Married joint">Married joint</option>
            <option value="Married seperately">Married Seperately</option>
            <option value="Head of house">Head of house</option></select></p>
            
            <p><label>no.dependents</label><select name="dependents" value="<?php echo isset($_POST['dependents']) ? $_POST['dependents'] : 0; ?>">
            <option >0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option></select></p>
            <p><label>monthly deduction $</label><input type="number" value="<?php echo isset($_POST['deduction']) ? $_POST['deduction'] : 0; ?>" class="big-box" name="deduction" ></p>
            <br>
            
      <input type = "checkbox" class = "first-box" value = "box1" name = "yearly" <?php if(isset($_POST['yearly'])) echo "checked='checked'"; ?> /> Yearly
      <input type = "checkbox" class = "second-box" value = "box2" name = "monthly" <?php if(isset($_POST['monthly'])) echo "checked='checked'"; ?> /> Monthly
      <input type = "checkbox" class = "third-box" value = "box3" name = "four-weekly" <?php if(isset($_POST['four-weekly'])) echo "checked='checked'"; ?> /> 4-Weekly
      <input type = "checkbox" class = "fourth-box" value = "box4" name = "two-weekly" <?php if(isset($_POST['two-weekly'])) echo "checked='checked'"; ?> /> 2-Weekly
      <input type = "checkbox" class = "fifth-box" value = "box5" name = "weekly" <?php if(isset($_POST['weekly'])) echo "checked='checked'"; ?> /> Weekly
      <input type = "checkbox" class = "fifth-box" value = "box6" name = "daily" <?php if(isset($_POST['daily'])) echo "checked='checked'"; ?> /> daily
      <input type = "submit" id = "submit-button" value= "Submit">
            
	</form>
       <!--<label>salary</label>
    <p class="question-mark">&#10068;</p><input class="big-box" type="number" name="salary">
        <br>
        <label>monthly</label>
        <p class="question-mark">&#10068;</p><input class="small-box " type="number" name="month1"><div class="at-class">@</div><input class="small-box"  name="monthly" value="1.5">
        <br>
        <label>overtime</label>
        <p class="question-mark">&#10068;</p><input class="small-box" type="number" name="month2"><div class="at-class">@</div><input class="small-box"  name="overtime" value="2">
        <br>
        <label>Filling status</label>
          <p class="question-mark">&#10068;</p><select class="align-right" name="staus">
            <option value="Single">Single</option>
            <option value="Married joint">Married joint</option>
            <option value="Married seperatly">Married Seperatly</option>
            <option value="Head of house">Head of house</option>
      </select>
       <br>
        <label>no.dependent</label>
        <p class="question-mark">&#10068;</p><select class="align-right" name="dependent">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
      </select>
        
        <br>
        <label>monthly deduction</label>
        <p class="question-mark">&#10068;</p><input class="big-box"  type="number" name="deduction">-->
        
    
    </section>
    <section class="content2">
        <h2 class="contect2">Using The Tax Calculator</h2>
        <p>To start using The Tax Calculator, simply enter your annual salary in the "Salary" field in the left-hand table above. If you know your tax code you can enter it, or else leave it blank.

If you do any overtime, enter the number of hours you do each month and the rate you get paid at - for example, if you did 10 extra hours each month at time-and-a-half, you would enter "10 @ 1.5". 5 hours double time would be "5 @ 2". The Fair Labor Standards Act requires that all non-exempt employees are paid overtime rates of at least one and a half times normal wage for any work over 40 hours per week. More information here.

Select your filing status from the drop-down. Choose whether you are filing as an individual ("Single"), as a married couple filing a joint return, as a married individual filing separately from your spouse, or as the head of household.

Choose the number of dependents you have, excluding yourself and your spouse, who are already included in the default standard deduction. If you have any other deductions (such as contributions to a retirement plan) enter the monthly amount into the deductions field.

You can read more about the thresholds and rates used by The Tax Calculator on the about page.</p>
        
    </section>
    <!--<input type="checkbox" name="vehicle" value="Bike">I have a bike
<input type="checkbox" name="vehicle" value="Car">I have a car 
   <input type="checkbox" name="vehicle" value="Car">I have a car 
   <input type="checkbox" name="vehicle" value="Car">I have a car -->
    </article>

<!--<section id="content3">
 <form id="checkbox-form" method="post">
      
       <input type = "checkbox" class = "first-box" value = "box1" name = "yearly" <?php if(isset($_POST['yearly'])) echo "checked='checked'"; ?>/> Yearly
      <input type = "checkbox" class = "second-box" value = "box2" name = "monthly" <?php if(isset($_POST['monthly'])) echo "checked='checked'"; ?>/> Monthly
      <input type = "checkbox" class = "third-box" value = "box3" name = "four-weekly" <?php if(isset($_POST['four-weekly'])) echo "checked='checked'"; ?> /> 4-Weekly
      <input type = "checkbox" class = "fourth-box" value = "box4" name = "two-weekly" <?php if(isset($_POST['two-weekly'])) echo "checked='checked'"; ?> /> 2-Weekly
      <input type = "checkbox" class = "fifth-box" value = "box5" name = "weekly" <?php if(isset($_POST['weekly'])) echo "checked='checked'"; ?> /> Weekly
      <input type = "checkbox" class = "fifth-box" value = "box6" name = "daily" <?php if(isset($_POST['daily'])) echo "checked='checked'"; ?> /> daily
      <input type = "submit" id = "submit-button" value= "Submit">
       <!--<input type="checkbox" name="vehicle" value="Auto"><p><span class="click1">I have a bike</span></p> 
       <input type="checkbox" name="vehicle" value="Van"><p><span class="click1">I have a bike</span></p>
</form>
  </section>-->
   <article id="main-content-second">
   <h1 style="background-color:white;">Table with calculated value</h1>
   
    <table  id="default">
        <tr>
            <td><br></td>
        </tr>
        <tr>
            <td>Gross Income</td>
        </tr>
        <tr>
            <td>Deduction</td>
        </tr>
        <tr>
            <td>Taxable Income</td>
        </tr>
        <tr>
            <td>Federal Income Tax</td>
        </tr>
        <tr>
            <td>Social Seccurity</td>
        </tr>
        <tr>
            <td>Take Home</td>
        </tr>
    </table>
    <table  id="yearly">
        <tr>
            <td><b>Yearly</b></td>
        </tr>
        <tr>
            <td>$<?php echo $Grossincome ?></td>
        </tr>
        <tr>
            <td>$<?php echo $Deduction ?></td>
        </tr>
        <tr>
            <td>$<?php echo $Taxableincome ?></td>
        </tr>
        <tr>
            <td>$<?php echo $FT ?></td>
        </tr><tr>
            <td>$<?php echo $Est ?></td>
        </tr>
        <tr>
            <td>$<?php echo $TK ?></td>
        </tr>
        
    </table>
     <table id="monthly">
        <tr>
            <td><b>Monthly</b></td>
        </tr>
         <tr>
            <td>$<?php echo round(($Grossincome/12),2) ?></td>
        </tr>
        <tr>
            <td>$<?php echo round(($Deduction/12),2) ?></td>
        </tr>
        <tr>
            <td>$<?php echo round(($Taxableincome/12),2) ?></td>
        </tr>
        <tr>
            <td>$<?php echo round(($FT/12),2) ?></td>
        </tr><tr>
            <td>$<?php echo round(($Est/12),2) ?></td>
        </tr>
        <tr>
            <td>$<?php echo round(($TK/12),2) ?></td>
        </tr>
    </table>
    <table id="four-weekly">
        <tr>
            <td><b>4-weekly</b></td>
        </tr>
        <tr>
            <td>$<?php echo round(($Grossincome/13),2) ?></td>
        </tr>
        <tr>
            <td>$<?php echo round(($Deduction/13),2) ?></td>
        </tr>
        <tr>
            <td>$<?php echo round(($Taxableincome/13),2) ?></td>
        </tr>
        <tr>
            <td>$<?php echo round(($FT/13),2) ?></td>
        </tr><tr>
            <td>$<?php echo round(($Est/13),2) ?></td>
        </tr>
        <tr>
            <td>$<?php echo round(($TK/13),2) ?></td>
        </tr>
    </table>
    <table id="two-weekly">
        <tr>
            <td><b>2-weekly</b></td>
        </tr>
        <tr>
            <td>$<?php echo round(($Grossincome/26),2) ?></td>
        </tr>
        <tr>
            <td>$<?php echo round(($Deduction/26),2) ?></td>
        </tr>
        <tr>
            <td>$<?php echo round(($Taxableincome/26),2) ?></td>
        </tr>
        <tr>
            <td>$<?php echo round(($FT/26),2) ?></td>
        </tr><tr>
            <td>$<?php echo round(($Est/26),2) ?></td>
        </tr>
        <tr>
            <td>$<?php echo round(($TK/26),2) ?></td>
        </tr>
    </table>
    <table id="weekly">
        <tr>
            <td><b>weekly</b></td>
        </tr>
        <tr>
            <td>$<?php echo round(($Grossincome/52),2) ?></td>
        </tr>
        <tr>
            <td>$<?php echo round(($Deduction/52),2) ?></td>
        </tr>
        <tr>
            <td>$<?php echo round(($Taxableincome/52),2) ?></td>
        </tr>
        <tr>
            <td>$<?php echo round(($FT/52),2) ?></td>
        </tr><tr>
            <td>$<?php echo round(($Est/52),2) ?></td>
        </tr>
        <tr>
            <td>$<?php echo round(($TK/52),2) ?></td>
        </tr>
    </table>
    <table id="daily">
       <tr>
            <td><b>Daily</b></td>
        </tr>
        <tr>
            <td>$<?php echo round(($Grossincome/260),2) ?></td>
        </tr>
        <tr>
            <td>$<?php echo round(($Deduction/260),2) ?></td>
        </tr>
        <tr>
            <td>$<?php echo round(($Taxableincome/260),2) ?></td>
        </tr>
        <tr>
            <td>$<?php echo round(($FT/260),2) ?></td>
        </tr><tr>
            <td>$<?php echo round(($Est/260),2) ?></td>
        </tr>
        <tr>
            <td>$<?php echo round(($TK/260),2) ?></td>
        </tr>
    </table>
    
    <!--<div id="footer">
                
    &copy;Rajeswari Ramasamy
    </div>-->
    
            </article> 
                  
   <!--<div id="container">
   
   </div>
    <form method="post">
        First number:<br>
        <input type="number" name="firstnumber">
        <br>
        Last number:<br>
        <input type="number" name="lastnumber">
        <br><br>
        <input type="submit" value="Submit">
    </form>
       <table>
  <tr>
    <th>Company</th>
    <th>Contact</th>
    <th>Country</th>
  </tr>
  <tr>
    <td>Alfreds Futterkiste</td>
    <td><?php echo $addition;?></td>
    <td>Germany</td>
  </tr>
  <tr>
    <td>Centro comercial Moctezuma</td>
    <td>Francisco Chang</td>
    <td>Mexico</td>
  </tr>
  <tr>
    <td>Ernst Handel</td>
    <td>Roland Mendel</td>
    <td>Austria</td>
  </tr>
  <tr>
    <td>Island Trading</td>
    <td>Helen Bennett</td>
    <td>UK</td>
  </tr>
  <tr>
    <td>Laughing Bacchus Winecellars</td>
    <td>Yoshi Tannamuri</td>
    <td>Canada</td>
  </tr>
  <tr>
    <td>Magazzini Alimentari Riuniti</td>
    <td>Giovanni Rovelli</td>
    <td>Italy</td>
  </tr>
</table>-->
        
    <script type="text/javascript">
        var e = document.getElementById('log');
e.mouseenter = function() {
  document.getElementById('hover').style.visibility = 'visible';
}
e.mouseleave = function() {
  document.getElementById('hover').style.visibility = 'hidden';
}
       
/**$(document).ready(function(){
    $("#log").mouseenter(function(){
        $("#hover").show();
    });
    $("#log").mouseleave(function(){
        $("#hover").hide();
    });
});**/

        /**$(document).ready(function () {
    $('.first-box').change(function () {
      $('#first').fadeToggle();
    });
          $('.second-box').change(function () {
      $('#second').fadeToggle();
    });
          $('.third-box').change(function () {
      $('#third').fadeToggle();
    });
          $('.fourth-box').change(function () {
      $('#fourth').fadeToggle();
             
    });
          $('.fifth-box').change(function () {
      $('#fifth').fadeToggle();
              
              
    });
             $('.sixth-box').change(function () {
      $('#sixth').fadeToggle();
              
              
    });
        
});
});**/
       

    </script>
</body>
</html>