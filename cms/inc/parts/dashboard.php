<div class="bit-1">

	<h1 style="padding-top:2px;">&nbsp;CMS DASHBOARD</h1>
	
	<ul class="tab">
		<li><a id="trigger-startpage" href="#" class="tablinks" onclick="openTab(event, 'cms-startpage')">Start Page</a></li>
		<li><a id="trigger-basics" href="#" class="tablinks" onclick="openTab(event, 'cms-basics')">Basics</a></li>
		<li><a id="trigger-structure" href="#" class="tablinks" onclick="openTab(event, 'cms-structure')">Structure</a></li>
		<li style="float:right;"><a id="trigger-system" href="#" class="tablinks" onclick="openTab(event, 'cms-system')"><img style="height:25px;width:25px;" src="/img/core/settings.svg" alt=""></a></li>
		<li style="float:right;"><a href="/cms/trash" class="tablinks"><img style="height:25px;width:25px;" src="/img/core/trash.svg" alt=""></a></li>
		<li style="float:right;"><a id="trigger-advanced" href="#" class="tablinks" onclick="openTab(event, 'cms-advanced')">Advanced</a></li>
	</ul>

	<div style="text-align:center;padding:15% 0px;" id ="cms_start_page">
		<h2 style="font-size:40px;line-height:80px;padding-bottom:1%;">Willkommen zurück, <span style="color:red;"><?php echo $user['name'];?></span></h2>
	</div>

	<div id="cms-startpage" class="tabcontent">
		<!-- used rewriterule parameter: id=1 & key=startpage -->
		<a href="/cms/edit/startpage">Edit Start Page</a><br><br>
		<a href="#">Reset Start Page</a><br><br>
	</div>

	<div id="cms-basics" class="tabcontent">

		<a href="/cms/new/project">Add Project</a><br><br>
		<!-- used rewriterule parameter: key=archive -->
		<!--<a href="/cms/add/archive/project">Add Archived Project</a><br><br>-->
		<!-- used rewriterule parameter: key=unique -->
		<!--<a href="/cms/add/unique/project">Add Unique Page</a><br><br>-->			

	</div>

	<div id="cms-structure" class="tabcontent">
		<!-- used rewriterule parameter: key=archive -->
		<a href="/cms/add/archive">Add Archive</a><br><br>
		<!-- used rewriterule parameter: key=category -->
		<a href="/cms/add/category">Add Category</a><br><br>
		<!-- used rewriterule parameter: key=sub-category -->
		<a href="/cms/add/sub-category">Add Sub Category</a><br><br>	
	</div>

	<div id="cms-system" class="tabcontent">
		<br><br>
		System Language: 
		<select name="" id="">
			<option value="de">Deutsch</option>
			<option value="en">English</option>
		</select>
		<br><br>
	</div>

	<div id="cms-dust-bin" class="tabcontent">
		<br><br>
	</div>

	<div id="cms-advanced" class="tabcontent">
		<br><br>
		<button>Reset Database</button>
		<br><br>
		<button>Update System</button>
		<br><br>
	</div>



</div>
	<div class="break40"><br></div>
<script>

	var i; 
	var tabcontent = document.getElementsByClassName("tabcontent");
	var tablinks = document.getElementsByClassName("tablinks");
		for (i = 0; i < tablinks.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" activeTab", "");
		//alert(tablinks[i].id);
	}

	var str = location.hash;
	var res = str.substring(5);
	document.getElementById("trigger-"+res).className += " activeTab";
		if (location.hash) {
		setTimeout(function() {
		window.scrollTo(0, 0);
		}, 1);
	}
	function openTab(evt, acttab) {
		document.getElementById("cms_start_page").style.display = "none";

		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}
		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" activeTab", "");
		}
		document.getElementById(acttab).style.display = "block";
		evt.currentTarget.className += " activeTab";
		location.hash = acttab;
		evt.preventDefault();
		window.scrollTo(0, 0);
	}

	for (i = 0; i < tabcontent.length; i++) {

		if ('#'+tabcontent[i].id == location.hash){
			document.getElementById("cms_start_page").style.display = "none";

			tabcontent[i].style.display = "block";
			tablinks[i].className += " activeTab";
		}
	}


	var tablinks = document.getElementsByClassName("tablinks");
		for (i = 0; i < tablinks.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" activeTab", "");
		//alert(tablinks[i].id);
	}

	var str = location.hash;
	var res = str.substring(5);
	document.getElementById("trigger-"+res).className += " activeTab";


	if (location.hash) {
		setTimeout(function() {
		window.scrollTo(0, 0);
		}, 1);
	}
</script>
