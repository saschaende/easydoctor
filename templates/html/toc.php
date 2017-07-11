<?php $i=1; foreach ($toc as $line): ?>
<li>
    <a href="page<?php echo $line['num']; ?>.html"><?php echo $line['title']; ?><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="flot.html">Flot Charts</a>
        </li>
        <li>
            <a href="morris.html">Morris.js Charts</a>
        </li>
    </ul>
    <!-- /.nav-second-level -->
</li>
<?php endforeach; ?>