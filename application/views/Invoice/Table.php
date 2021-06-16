 <?php

      for ($i = 0; $i < count($res); $i++) {
      ?>
       <tr>
             <td><?php echo $i + 1;
                  ?></td>
             <td><?php echo $res[$i]['clientName'];
                  ?></td>
             <td><?php echo $res[$i]['phone'];
                  ?></td>
             <td><?php echo $res[$i]['email'];
                  ?></td>
             <td><?php echo $res[$i]['add'];
                  ?></td>
             <td class="text-right"><?php echo $res[$i]['total'];
                                    ?></td>
             <td class="text-right"><?php echo $res[$i]['paid'];
                                    ?></td>
             <td class="text-right"><?php echo $res[$i]['due'];
                                    ?></td>
             <td>
                   <a id="<?php echo 'upd-' . ($i + 1) ?>" data-id="<?php echo $res[$i]['id'] ?>" class="btn btn-primary" onclick="getInvoice(this.id)">Edit</a>
                   <a id="<?php echo 'del-' . ($i + 1) ?>" data-id="<?php echo $res[$i]['id'] ?>" class="btn btn-danger" onclick="delInvoice(this.id)">Del</a>
             </td>
       </tr>
 <?php
      }
      ?>