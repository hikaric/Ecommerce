<?php 
	require_once '../views/inc/head.php';
?>
<style>
	a {
		text-decoration : none;
	}
	a:hover {
		text-decoration : underline;
	}
</style>
<title>Thống kê doanh số</title>
</head>
<body>

<?php require_once '../views/inc/sidebar.php'; ?>

 <main style="margin-left: 220px" class="p-3">
 <div class="container-fluid my-5 bg-light py-3">
	<h4>Thống kê doanh số 123</h4>
	<div class="table-responsive-lg">
	<table class="table table-hover">
		<?php 
			$count=0;
		?>
		<thead class="text-center align-middle">
		<tr>
			<td>Mã sản phẩm</td>
			<td>Tên sản phẩm</td>
			<td>Số lượng đã bán</td>
			<td>Doanh số</td>

		</tr>
		</thead>

		<tbody class="text-center align-middle">
			<!-- Code hàm ở đây -->
		</tbody>


	</table>
	</div>
	
</body>
</html>