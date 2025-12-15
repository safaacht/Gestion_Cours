<?php 
include('../includes/header.php');
include('../includes/connect_php.php');
$cid=$_GET['course_id'];
$course=mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM courses WHERE id=$cid"));
$res=mysqli_query($connect,"SELECT * FROM sections WHERE courses_id=$cid ORDER BY position ASC");
?>
<h2>Sections - <?= $course['title'] ?></h2>
<a class="btn-secondary btn" href='../sections/add_section.php ?course_id=<?= $cid ?>>'>Ajouter section</a>
<table border='1'>
<tr><th>ID</th><th>Titre</th><th>Pos</th><th>Content</th><th>Actions</th></tr>
<?php while($s=mysqli_fetch_assoc($res)){ ?>
<tr>
<td><?= $s['id'] ?></td>
<td><?= htmlspecialchars($s['title'])?></td>
<td><?= $s['position']?></td>
<td><?= htmlspecialchars($s['content']) ?></td>
<td>
<a class="btn" href='../sections/section_edit.php?id=<?= $s['id'] ?>'>Update</a>
<a class="btn-danger btn" href='../sections/section_delete.php?id=<?= $s['id'] ?>&course_id=<?= $cid ?>'>Delete</a>
</td>
</tr>
<?php }?>
</table>
<?php include '../includes/footer.php' ?>