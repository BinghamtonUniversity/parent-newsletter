<?php
include_once('base/include_top.php');
if(isset($_GET['search']) && strlen(trim($_GET['search'])) > 0 )
  $posts = Posts::search($_GET['search']);
else
  $posts = Posts::AllPosts(true,true);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"><head xmlns:ou="http://omniupdate.com/XSL/Variables">
<title>Binghamton University - Dean's message about Greek life status</title>
<link rel="stylesheet" type="text/css" href="http://www.binghamton.edu/css/styles.css" media="all"/><!--[if lt IE 7]>
	<script defer type="text/javascript" src="/scripts/pngfix.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/ie_low.css" media="all" />
	<![endif]--><link media="print" href="http://www.binghamton.edu/css/print.css" type="text/css" rel="stylesheet"/>
		<!-- com.omniupdate.properties -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="Keywords" content="Greek life, hazing, dean of students, Greek organizations, student safety ,"/>
		<meta name="Description" content="This page includes a message from the Dean of Students to a general audience and provides an update of the status of the Greek Life system at Binghamton University."/>
		<meta http-equiv="Content-Style-Type" content="text/css"/>
		<meta http-equiv="imageToolbar" content="no"/>
		<!-- /com.omniupdate.properties -->
	<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script><script type="text/javascript">
		var pageTracker = _gat._getTracker("UA-1861349-1");
		pageTracker._trackPageview();
	</script><script type="text/javascript">
      var page_id="http://www2.binghamton.edu/dean-of-students/deans-message.html";
     </script></head><body xmlns:ou="http://omniupdate.com/XSL/Variables" class="departmentPage"><div class="headerOuter"><div class="contentWidth headerInner"><a href="#skipHeader"><img src="/images/common/clear.gif" height="0" width="0" class="skipnav" alt="Skip header content and main navigation"/></a><!-- com.omniupdate.div path="/dean-of-students/logo.html" label="logo" --><img id="logoBackground" src="http://www2.binghamton.edu/images/common/bgHeader.gif" alt="" />
<img class="logoLink" usemap="#Map" src="http://www2.binghamton.edu/images/siteLogos/logo-dean-of-students.gif" alt="Binghamton University, State University of New York - Dean of Students" />
<map id="Map" name="Map">
<area shape="rect" coords="0,0,210,66" href="http://www2.binghamton.edu/index.html" />
<area shape="rect" coords="220,0,407,66" href="http://www2.binghamton.edu/dean-of-students/index.html" />
</map>
<!-- /com.omniupdate.div --><!-- com.omniupdate.div path="/inc/hdrQuickLinksDepartment.shtml" label="hdrQuickLinksDepartment" --><script src="https://www.google.com/jsapi?key=ABQIAAAA3ia0NPE98EwrkgLZHTSkgxTXO7ZdFP8GFbr4e1voZqr2tFi3GBQN00cLkqcQU9y6_jIvQSyed39Wfg">

</script>
<script> 
    //<![CDATA[
    if (typeof jQuery == 'undefined') {
        google.load("jquery", "1.6");
    }
    //]]>
</script>
<script src="/inc/header-search.min.js">

</script>

<form action="http://www2.binghamton.edu/results.html" id="cse-search-box">
  <div class="searchControls">
    <input type="hidden" name="cx" value="013262338783433875854:7stszgiris8" />
    <input type="hidden" name="cof" value="FORID:11" />
    <input type="hidden" name="ie" value="UTF-8" />
    <input type="text" name="q" size="31" class="searchBox" value="Search" onclick="this.select();" />
    <img src="/images/common/search.png" class="searchButton" alt="Search Button"/>
  </div>
</form>

<ul class="inlineList quickLinks" style="padding-top: 10px;">
	<li><a href="http://m.binghamton.edu/" title="Mobile">Mobile</a></li>
	<li>|</li>
	<li><a href="http://my.binghamton.edu" title="My Binghamton">My Binghamton</a></li>
	<li>|</li>
	<li><a href="http://www.binghamton.edu/admission.html" title="Apply">Apply</a></li>
	<li>|</li>
	<li><a href="/a-to-z/index.html" title="A-Z Index">A-Z Index</a></li>
</ul>

<div class="searchRadioButtons">
    <input id="search-filters1" name="tab" value="" checked="checked" type="radio">
	<label for="search-filters1">Pages</label>
	<input id="search-filters2" name="tab" value="people" type="radio">
	<label for="search-filters2">People</label>
</div>
<!-- /com.omniupdate.div --><!-- com.omniupdate.div path="/inc/hdrAudienceNavDepartment.shtml" label="hdrAudienceNavDepartment" -->    <ul class="inlineList audienceNav">
      <li><a href="http://www.binghamton.edu/future-students.html" title="Future Students">Future Students</a></li>
      <li>|</li>
      <li><a href="http://www.binghamton.edu/current-students.html" title="Current Students">Current Students</a></li>
      <li>|</li>
      <li><a href="http://www.binghamton.edu/visitors-and-community.html" title="Visitors &amp; Community">Visitors &amp; Community</a></li>
      <li>|</li>
      <li><a href="http://www.binghamton.edu/alumni/" title="Alumni">Alumni</a></li>
      <li>|</li>
      <li><a href="http://www.binghamton.edu/parents.html" title="Parents">Parents</a></li>
      <li>|</li>
      <li><a href="http://www.binghamton.edu/faculty-and-staff.html" title="Faculty &amp; Staff">Faculty &amp; Staff</a></li>
    </ul>
<!-- /com.omniupdate.div --></div></div><div class="pageWidth"><div class="mainNavOuter"><!-- com.omniupdate.div path="/dean-of-students/hnav.html" label="hnav" --><!-- com.omniupdate.editor csspath="/z-omniupdate/edit/department-header/hnav.css" width="1200" --><ul class="inlineList mainNav">
<li class="first"><a title="Dean's Message" href="http://www2.binghamton.edu/dean-of-students/deans-message.html">Dean's Message</a></li>
<li><a title="Programs/Services" href="http://www2.binghamton.edu/dean-of-students/services/index.html">Programs/Services</a></li>
<li><a title="People/Units" href="http://www2.binghamton.edu/dean-of-students/staff.html">People/Units</a></li>
<li><a title="For Students" href="http://www2.binghamton.edu/dean-of-students/students.html">For Students</a></li>
<li><a title="For Faculty &amp; Staff" href="http://www2.binghamton.edu/dean-of-students/faculty.html">For Faculty/Staff</a></li>
<li><a title="For Parents" href="http://www2.binghamton.edu/dean-of-students/parents/index.html">For Parents</a></li>
<li class="last"><a title="Resources/Links" href="http://www2.binghamton.edu/dean-of-students/resources.html">Resources</a></li>
</ul>
<!-- /com.omniupdate.div --></div></div><div class="contentWidth bodyContent"><div class="colLeft" style="margin-top: 6px;"><!-- com.omniupdate.div path="/dean-of-students/nav.html" label="nav" group="Everyone" button="781" --><!-- Begin subnav -->
<ul class="subNav">
<li class="first"><a title="Dean's Message" href="displayNew.php">Dean's Message</a></li>
<li><a title="Dean's Message archive list" href="archivesListNew.php">Dean's Message archive list</a></li>
</ul>
<!-- End subnav -->
<!-- /com.omniupdate.div --></div><div class="contentBanner"> </div><div class="content contentFull"><div class="bcOuter"><!-- com.omniupdate.div path="/z-omniupdate/fakes/breadcrumb.html" label="breadcrumb" --><ul class="bc inlineList"><li><a href="/dean-of-students/">Archive list od dean's message</a></li></ul><!-- /com.omniupdate.div --></div>
		<!-- com.omniupdate.div label="content" group="Everyone" button="787" break="break" --><!-- ouc:editor csspath="/z-omniupdate/edit/department-content2/content.css" cssmenu="/z-omniupdate/edit/edit-main.txt" width="960"/ --><img src="http://www2.binghamton.edu/images/655x127px/studentaffairs1.jpg" alt="Banner" width="655" height="127"/>

<?php 

$monthName = array(
  1 => "Jan",
  2 => "Feb",
  3 => "Mar",
  4 => "Apr",
  5 => "May",
  6 => "Jun",
  7 => "Jul",
  8 => "Aug",
  9 => "Sep",
  10 => "Oct",
  11 => "Nov",
  12 => "Dec"
  );

if(isset($_GET['search']) && strlen(trim($_GET['search'])) > 0 ) {
  $_GET['search'] = trim($_GET['search']);
?>
<h1> Search Result for <?=$_GET['search']?> </h1>
<?php 
}
else {
?>
<h1> Archives list </h1>
<?php
} ?>
<ul>
  <?php
  $currentYear = null;
  $currentMonth = null;
  $changeMonth = false;
  foreach ($posts as $post) {
    $published = @getdate(date($post->getPublishedTimeStamp()));
    if($published['year'] !== $currentYear || $published['mon'] !== $currentMonth) 
    {   
      $currentYear = $published['year'];
      $currentMonth = $published['mon'];
      $changeMonth = true;
  ?>
  <h3><?=$published['year'];?> - <?=$monthName[$published['mon']];?></h3>
    <?php
    } ?>
    <li>
      <a href="displayNew.php?id=<?=$post->getPostID();?>"><?=$post->getTitle();?></a>
    </li>
  <?php
  if($changeMonth) { ?>
  <!--</li>-->
  <?php }
  $changeMonth = false;
  }
  ?>
</ul>

<br><br>
	</div></div><!-- com.omniupdate.div path="/z-omniupdate/fakes/footer.html" label="footer" --><!-- begin footer -->
<div class="contentWidth footerOuter">
    <div class="footerLeft" style="width: 340px; padding-left: 20px;">
    <div class="addlInfo">
    <div style="margin-bottom: 5px"><em>Connect with Binghamton:</em></div>
    <a href="http://twitter.com/binghamtonu">
            <img style="display: inline;" src="http://www.binghamton.edu/images/twitter-icon.png" alt="Twitter icon links to Binghamton University's Twitter page"/>
          </a>

          <a href="http://www.youtube.com/user/BinghamtonUniversity">
              <img style="display: inline; padding-left: 8px" src="http://www.binghamton.edu//images/youtube-icon.png" alt="YouTube icon links to Binghamton University's YouTube page"/>
          </a>
          <a href="http://www.facebook.com/pages/Binghamton-NY/Binghamton-University/51791915551">
              <img style="display: inline; padding-left: 8px" src="http://www.binghamton.edu//images/facebook-icon.png" alt="Facebook icon links to Binghamton University's Facebook page"/>
          </a>
          <a href="http://pinterest.com/binghamtonu/"><img style="display: inline; padding-left: 9px" src="http://www.binghamton.edu//images/pinterest.png" alt="Pinterest icon links to Binghamton University's Pinterest page" width="32" height="32" /></a>
      
    </div>
  </div>
    <div class="footerRight" style="width: 570px; padding-right: 20px; line-height: 180%;">
    <div class="copyright" style="text-align: right">&copy; 2012 Binghamton University, State University of New York<br />
        <a href="http://www2.binghamton.edu/magazine/">Binghamton Magazine</a> | <a href="http://www2.binghamton.edu/inside/">Inside Binghamton</a> | <a href="http://www.binghamton.edu/photos">Daily Photo</a><br />
        <a href="http://www.binghamton.edu/about/contact-us.html">Contact Us</a> | <a href="http://www.telecom.binghamton.edu/directory/directory.search">Directory</a></div>
    <div class="feedsNetworks"> 
		
    <div class="shareLinks">         
         
      </div>
    </div>
  </div>
</div>
<!-- end footer -->
<!-- /com.omniupdate.div --><!-- com.omniupdate.ob --><p class="dired"><a href="http://www.omniupdate.com/oucampus-binghamton/de.jsp?user=Migration&amp;site=binghamton&amp;path=%2Fdean-of-students%2Fdeans-message.pcf">Last Updated: 9/28/12</a></p><!-- /com.omniupdate.ob --></body></html>