<div class="toc">
    <h1>Inhaltsverzeichnis</h1>

    <table style="width:100%;">
        <?php $i=1; foreach ($toc as $line): ?>
            <tr>
                <?php if ($line['type'] == 'h1'): ?>
                    <td style="width:100%;"><a href="#heading<?php echo $line['num']; ?>" style="font-weight: bold;"><?php echo $i; ?>. <?php echo $line['title']; ?></a></span></td>
                    <?php $i++; ?>
                <?php endif; ?>
                <?php if ($line['type'] == 'h2'): ?>
                    <td style="width:100%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#heading<?php echo $line['num']; ?>"><?php echo $line['title']; ?></a></td>
                <?php endif; ?>
                <td style="text-align: right;"><?php echo $line['page']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>