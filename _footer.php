	<footer>
		<p>&copy; <span id=""></span> .</p>
		<script>
		// mengambil tanggal hari ini
		var now = new Date();
		var tahun = now.getFullYear();
		// menampilkan tahun di dalam elemen HTML
		document.getElementById("").innerHTML = tahun;
		</script>
		
	</footer>

	<script src="<?=url('_assets/js/rumah_laundry.js')?>"></script>
</body>
</html>