</body>

<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.min.js"></script>



<script type="text/javascript">

$('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})

$('#myTabs a[href="#hibtc"]').tab('show') // Select tab by name
$('#myTabs a[href="#hibtceth"]').tab('show') // Select tab by name

</script>

</html>
