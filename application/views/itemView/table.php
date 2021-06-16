<?php for ($i = 0; $i < count($res); $i++) { ?>
    <tr id="<?php echo "row-" . ($i + 1) ?>">
        <td class="text-center"><?php echo $i + 1; ?></td>
        <td class="text-left"><?php echo $res[$i]['itemName']; ?></td>
        <td class="text-left"><?php echo $res[$i]['price']; ?></td>
        <td class="text-center"><object data="<?php echo base_url() . 'upload/' . $res[$i]['img']; ?>" height="50px" width="50px"></object></td>
        <td class="text-center"><iframe src='<?php echo $this->db->query('select link from itemmaster where itemId=?', $res[$i]['itemId'])->row()->link ?>' height=60px width=60px></iframe></td>
        <td class="text-center"><?php echo $res[$i]['created_Date']; ?></td>
        <td class="text-left"><?php echo $res[$i]['created_By']; ?></td>
        <td class="text-center">
            <button type="button" id="<?php echo 'upd-' . ($i + 1); ?>" data-id="<?php echo $res[$i]['itemId'] ?>" class="btn btn-primary" onclick="getItem(this.id)">Update</button>
            <a type="button" id="<?php echo 'del-' . ($i + 1); ?>" data-id="<?php echo $res[$i]['itemId'] ?>" class="btn btn-danger" onclick='deleteItem(this.id)'>Delete</a>
        </td>
    </tr>
<?php } ?>