<?php
$db = new PDO("mysql:host=127.0.0.1;dbname=computer", "root", "");

function findProcessor()
{
    global $db;
    $statement = $db->prepare("SELECT netname, motherboard, vendor, guarantee FROM computers inner join processors on FID_Processor = ID_Pocessor WHERE processors.name=?");
    $statement->execute([$_POST["processor"]]);
    $str = "<table>";
    $str .= " <tr>
 <th> Net Name  </th>
 <th> Motherboard </th>
 <th> Vendor </th>
 <th> Guarantee </th>
</tr> ";
    while ($data = $statement->fetch()) {
        $str .= " <tr>
 <th> {$data['netname']}  </th>
 <th> {$data['motherboard']} </th>
 <th> {$data['vendor']} </th>
 <th> {$data['guarantee']} </th>
</tr> ";
    }
    $str .= "</table>";
    echo $str;
}

function findSoftware()
{
    global $db;
    $statement = $db->prepare("SELECT netname, motherboard, vendor, guarantee FROM computers inner join computer_softwares on ID_Computer = FID_Computer inner join softwares on FID_Software = ID_Software WHERE softwares.name=?");
    $statement->execute([$_POST["software"]]);
    $str = "<table>";
    $str .= " <tr>
 <th> Net Name  </th>
 <th> Motherboard </th>
 <th> Vendor </th>
 <th> Guarantee </th>
</tr> ";
    while ($data = $statement->fetch()) {
        $str .= " <tr>
 <th> {$data['netname']}  </th>
 <th> {$data['motherboard']} </th>
 <th> {$data['vendor']} </th>
 <th> {$data['guarantee']} </th>
</tr> ";
    }
    $str .= "</table>";
    echo $str;
}

function findGuarantee()
{
    global $db;
    $statement = $db->prepare("SELECT netname, motherboard, vendor, guarantee FROM computers WHERE guarantee < ?");
    $statement->execute([date("Y-m-d")]);
    $str = "Guarantee out:";
    $str .= "<table>";
    $str .= " <tr>
 <th> Net Name  </th>
 <th> Motherboard </th>
 <th> Vendor </th>
 <th> Guarantee </th>
</tr> ";
    while ($data = $statement->fetch()) {
        $str .= " <tr>
 <th> {$data['netname']}  </th>
 <th> {$data['motherboard']} </th>
 <th> {$data['vendor']} </th>
 <th> {$data['guarantee']} </th>
</tr> ";
    }
    $str .= "</table>";
    echo json_encode($str);
}
if (isset($_POST["processor"])) {
    findProcessor();
} elseif (isset($_POST["software"])) {
    findSoftware();
}elseif (isset($_POST["guarantee"])) {
    findGuarantee();
}

