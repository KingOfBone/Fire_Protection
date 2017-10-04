<?php
    ob_start();
    session_start();
    include_once "../../config/koneksi.php";
    $flag = $_GET['flag'];
?>

<link href="../../assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
<script src="../../assets/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="windowfiles/dhtmlwindow.js"></script>
<body>
<script language="javascript">
    function cek(txtVal,txtVa3)
    {
        var a  = "gi";
        var aa = a.concat(txtVa3);
        try
        {
            parent.window.document.getElementById(aa).value = txtVal;
        }
        catch(en){}
        parent.window.fdsubject.hide();
    }
</script>

<form id="live-search" action="" class="styled" method="post">
    <div class="container">
        <div class="row">
        <div class="col-md-2"></div>
            <div class="col-md-8" style="position: fixed; right: 0px;">
                <input type="text" class="form-control" id="filter" value=""  placeholder="ketikkan nama GI" />
            </div>
        </div>
    </div>
</form>

<nav>
    <ul>

        <?php
            $sql = mysql_query("SELECT * from BaseCamp") or die ("Gagal login");
            while ($row= mysql_fetch_array($sql)) {
        ?>
                <li style="list-style: none; margin-left: 20px;">
                    <input style="border:0" type="radio" name="txtRadio" onClick="cek('<?php echo $row['id_bc']; ?>','<?php echo $flag; ?>')" /><?php echo $row['nama']; ?><br>
                </li>
        <?php
            }
        ?>
    </ul>
</nav>

<script>
    $(document).ready(function(){
        $("#filter").keyup(function(){

            // Retrieve the input field text and reset the count to zero
            var filter = $(this).val(), count = 0;

            // Loop through the comment list
            $("nav ul li").each(function(){

                // If the list item does not contain the text phrase fade it out
                if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                    $(this).fadeOut();

                    // Show the list item if the phrase matches and increase the count by 1
                } else {
                    $(this).show();
                    count++;
                }
            });
        });
    });
</script>
<?php ob_flush();  ?>
