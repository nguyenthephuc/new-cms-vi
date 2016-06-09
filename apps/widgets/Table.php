<?php
/**
 * @author  The Phuc
 * @since   17/04/2016
 * @package TABLE
 */
class Table {

    public static function active($data = null)
    {
        #start function
        if(!$data) return false; ?>
        <div class="text-left">
            <h6 class="text-left text-info"><?php echo $data['source']['from']+1 ?>-<?php echo ($data['source']['current'] == $data['source']['total'])? $data['source']['sumRecord'] : ($data['source']['from'])+$data['source']['turn'] ?> | Tổng số <?php echo $data['source']['sumRecord'] ?></h6>
        </div>

        <table style="width: 100%" border="1" cellspacing="1" cellpadding="3"  bgcolor="#999999">
            <thead>
                <tr>
                    <?php foreach($data['title'] as $td): ?>
                        <td><?php echo $td ?></td>
                    <?php endforeach; ?>
                        <td>Thao tác</td>
                </tr>
            </thead>
            <tbody>
                <?php if(count($data['source']['data'])): ?>
                <?php foreach($data['source']['data'] as $item): ?>
                <tr>
                    <?php foreach ($data['col'] as $col): ?>
                    <td>
                        <?php
                            if($col === 'status'){
                                echo (int)$item->$col === 1 ? '<span style="color: green">Hiển thị</span>' : '<span style="color: red">Đang ẩn</span>';
                            }else{
                                echo $item->$col;
                            }
                        ?>
                    </td>
                    <?php endforeach; ?>
                    <td width="120px">
                        <a href="<?php echo $data['link'][0] ?><?php echo $item->id ?>" target="_blank">Chỉnh sửa</a>
                        &nbsp;|&nbsp;
                        <?php if(isset($item->level) && (int)$item->level === 1): ?>
                        <span>Xóa</span>
                        <?php else: ?>
                        <a href="<?php echo $data['link'][1] ?><?php echo $item->id ?>" onclick="PopupCenterDual(this.href, 'abc', 700, 300); return false;">Xóa</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr><td colspan="<?php echo count($data['col'])+1 ?>" align="center">Không có đữ liệu</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- start paging -->
        <?php if($data['source']['total'] > 1): ?>
        <ul class="pagination">
            <?php if($data['source']['current'] > 1): ?>
            <li>
                <a class="request" href="<?php echo $data['link'][2].$data['source']['before'] ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php endif; ?>
            
            <?php for ($i=1; $i <= $data['source']['total']; $i++): ?>
                <?php if((int)$data['source']['current'] === $i): ?>
                    <li class="active"><a><?php echo $i ?></a></li>
                <?php else: ?>
                    <li><a class="request" href="<?php echo $data['link'][2].$i ?>"><?php echo $i ?></a></li>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if($data['source']['current'] < $data['source']['total']): ?>
            <li>
                <a class="request" href="<?php echo $data['link'][2].$data['source']['next'] ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
            <?php endif; ?>
        </ul>
        <?php endif; ?>
        <!-- end paging -->
<?php } #end function
}