 <?php for($i=0;$i< count($res);$i++){?>
            <tr id="<?php echo "row-".($i+1) ?>">
                <td class="text-center"><?php echo $i+1;?></td>
                <td class="text-left"><?php echo $res[$i]['userName'];?></td>
                <td class="text-left"><?php echo $res[$i]['email'];?></td>
                <td class="text-center"><?php echo $res[$i]['phone'];?></td>
                <td class="text-center"><?php echo $res[$i]['created_Date'];?></td>
                <td class="text-left"><?php echo $res[$i]['created_By'];?></td>
                <td class="text-center">
                    <a type="button" id="<?php echo 'upd-'.($i+1); ?>"data-id="<?php echo $res[$i]['USERID']?>"class="btn btn-primary" aria-expanded="false"onclick='getUser(this.id)'>Edit</a>
                    <a type="button" id="<?php echo 'del-'.($i+1); ?>"data-id="<?php echo $res[$i]['USERID']?>"class="btn btn-danger" onclick='deleteUser(this.id)'>Delete</a>
                </td>
            </tr>
 <?php }?>