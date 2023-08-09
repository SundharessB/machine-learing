<?php
include './adminheader.php';
if(!isset($_POST['submit'])) {
?>
<form name="f" action="" method="post">
    <table class="form_tab">
        <thead>
            <tr>
                <th colspan="2">EYE TISSUE MASTER</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Tissue Type</th>
                <td><input type="text" name="tissuetype" required></td>
            </tr>
            <tr>
                <th>Sight</th>
                <td><input type="text" name="sight" required></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Store Data">
                </td>
            </tr>
        </tfoot>
    </table>
</form>
<?php
} else {
    extract($_POST);
    mysqli_query($link, "insert into eyetissue(tissuetype,sight) values ('$tissuetype','$sight')") or die(mysqli_error($link));
    echo "<div class='msg'>Tissue Stored Successfully...!<br><a href='adminhome.php'>Back</a></div>";
}
    $res1 = mysqli_query($link, "select * from eyetissue") or die(mysqli_error($link));
    echo "<table class='report_tab'><thead><tr><th colspan='3'>EYE TISSUE LIST";
    echo "<tr><th>Tissue Type<th>Sight<th>Task<tbody>";
    $flag = true;
        while($r1 = mysqli_fetch_row($res1)) {
            if($flag) {
                echo "<tr class='dark'>";
                $flag=false;
            } else {
                echo "<tr class='light'>";
                $flag=true;
            }
            foreach($r1 as $rr) {                
                echo "<td>$rr";
            }
            echo "<td><a href='adminhome.php?ttype=$r1[0]' onclick=\"javascript:return confirm('Are You Sure to Delete ?')\">Delete</a>";
        }
    echo "</tbody></table>";
    mysqli_free_result($res1);
    if(isset($_GET['ttype'])) {
        $ttype = $_GET['ttype'];
        mysqli_query($link, "delete from eyetissue where tissuetype='$ttype'") or die(mysqli_error($link));
        header("Location:adminhome.php");
    }
echo "</div>";
include './footer.php';
?>