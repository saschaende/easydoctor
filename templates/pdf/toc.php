<div class="toc">
    <h1><?php echo $this->settings['project']['title']; ?></h1>

    <table style="width:100%;">
        <?php $h1count=1; $h2count=1; foreach ($toc as $line): ?>
            <tr>
                <?php if ($line['type'] == 'h1'): ?>
                    <td style="width:100%;"><a href="#page<?php echo $h1count; ?>" style="font-weight: bold;"><?php echo $h1count; ?>. <?php echo $line['title']; ?></a></span></td>
                    <?php $h1count++; ?>
                <?php endif; ?>
                <?php if ($line['type'] == 'h2'): ?>
                    <td style="width:100%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#part<?php echo $h2count; ?>"><?php echo $line['title']; ?></a></td>
                    <?php $h2count++; ?>
                <?php endif; ?>
                <td style="text-align: right;"><?php echo $line['page']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>