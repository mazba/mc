<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$CI =& get_instance();
?>


<div id="system_content" class="dashboard-wrapper col-lg-12" >
  <div class="row-fluid">
    <div style="width:100%;">
      <p class="para_1" style="padding-bottom:20px;"><span id="dropcap">বাং</span>লাদেশে গত দশক থেকে শিক্ষায় আইসিটি’র ব্যবহার উল্লেখযোগ্যহারে বৃদ্ধি পেয়েছে। সারা দেশে দ্রুত গতিতে <span id="dropcap">মাল্টিমিডিয়া</span> ক্লাসরুম ছড়িয়ে পড়ছে। কোন দেশের ভবিষ্যৎ নির্ভর করে সেদেশের ক্লাসরুমগুলোতে কী হচ্ছে তার উপর। সুতরাং আমাদের মাল্টিমিডিয়া ক্লাসরুমগুলোর সুষ্ঠু ব্যবস্থাপনা মানসম্মত শিক্ষা অর্জনে কার্যকর ভূমিকা পালন করে। মাল্টিমিডিয়া ক্লাসরুমগুলো সচল রাখতে জেলা শিক্ষা অফিস ও জেলা প্রশাসন একযোগে কাজ করছে। এই কাজকে সহজ করতে <span id="dropcap">এটুআই</span>-এর উদ্যোগে একটি অনলাইন মাল্টিমিডিয়া ক্লাসরুম <span id="dropcap">ম্যানেজমেন্ট সিস্টেম</span> তৈরি করা হয়েছে। সমগ্র বাংলাদেশের মাল্টমিডিয়া ক্লাসরুমগুলো যেন কোন প্রকার বাধাবিঘ্নের সম্মুখীন না হয় এবং নিরবিচ্ছিন্নভাবে চলতে পারে সেজন্য এই মাল্টিমিডিয়া ক্লাসরুম ম্যানেজমেন্ট সিস্টেম চালু করা হয়েছে। এর মাধ্যমে সারা দেশের <span id="dropcap">সম্পূর্ণ চিত্র</span> উঠে আসবে যার ফলে কোথাও কোন সমস্যা দেখা দিলে তার সমাধানকল্পে দ্রুত উদ্যোগ নেয়া সম্ভব হবে।</p>
    </div>
  </div>

</div>

<!-- start slider -->
<?php /*?><div id="system_content" class="dashboard-wrapper col-lg-12">
    <div class="col-lg-9">
        <div class="row-fluid">
        <div style="width:100%; margin-bottom:15px; height:300px !important;">

            <div class="camera_wrap camera_azure_skin" id="camera_wrap_1">
                <div data-thumb="<?php echo base_url() ?>/images/slideshow/slide-1.jpg" data-src="<?php echo base_url() ?>/images/slideshow/slide-1.jpg">
                    <div class="camera_caption fadeFromBottom">
                        উদ্যোক্তা সম্মেলনে বক্তব্য রাখছেন মাননীয় প্রধানমন্ত্রী <em>১১ই নভেম্বর, ২০১৪ - জাতীয় প্যারেড স্কোয়ার</em>
                    </div>
                </div>
                <div data-thumb="<?php echo base_url() ?>/images/slideshow/slide-3.jpg" data-src="<?php echo base_url() ?>/images/slideshow/slide-3.jpg">
                    <div class="camera_caption fadeFromBottom">
                        নারী উদ্যোক্তা কর্তৃক সেবা প্রদান <em>ফুলতলা ডিজিটাল সেন্টার, গাজীপুর </em>
                    </div>
                </div>
                <div data-thumb="<?php echo base_url() ?>/images/slideshow/slide-6.jpg" data-src="<?php echo base_url() ?>/images/slideshow/slide-6.jpg">
                    <div class="camera_caption fadeFromBottom">
                        ডিজিটাল পাসপোর্ট গ্রহনের ফর্ম এখন পাওয়া যাচ্ছে সকল ডিজিটাল সেন্টারে
                    </div>
                </div>

        	</div>
        </div>
		</div>

        <div class="row-fluid">
            <div class="span-9">
                <div class="widget">
                    <div class="widget-header" style="padding-top:10px; padding-bottom:35px;">
                        <div class="title" style="font-family:nikoshBAN !important; font-size:19px !important;">
                            <marquee width="100%">
                                <?php
                                $notices = Website_helper::get_all_public_notices();
                                if(is_array($notices) && sizeof($notices)>0)
                                {
                                    foreach($notices as $notice)
                                    {
                                    ?>
                                        <a style="color: white;" href="<?php echo $CI->get_encoded_url('notice_management/public_notice/'); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $notice['notice_title'];?></a>
                                    <?php
                                    }
                                }
                                else
                                {
                                    echo $CI->lang->line('NO_PUBLIC_NOTICE');
                                }
                                ?>
                            </marquee>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="row-fluid">
                            <div class="metro-nav">
                                <div id="top_service_yesterday" class="metro-nav-block nav-block-dark-green double" style="width:32% !important;">
                                    <a  class=" external" id="1" href="javascript:void(0);" style=" margin-top:-20px; margin-left: -15px;text-align:center;">
                                        <div class="brand" style="width:100% !important;text-align:center !important;"><?php   echo 'প্রাথমিক';  //echo $this->lang->line('YESTERDAY_TOP_SERVICE_PROVIDER');?></div>
                                    </a>
                                </div>
                                <div id="top_income_yesterday" class="metro-nav-block nav-block-dark-green double" style="width:32% !important;">
                                    <a class="click2 external" id="1" href="javascript:void(0);" style=" margin-top:-20px; margin-left: -4px;text-align:center;">
                                        <div class="brand" style="width:100% !important;text-align:center !important;"><?php  echo 'মাধ্যমিক';  //echo $this->lang->line('YESTERDAY_TOP_INCOME_PROVIDER');?></div>
                                    </a>
                                </div>

                                <div id="top_service_lastsevendays" class="metro-nav-block nav-block-dark-green double" style="width:33% !important">
                                    <a class="click external" id="2" href="javascript:void(0);" style=" margin-top:-20px; margin-left: -15px; text-align:center;">
                                        <div class="brand" style="width:100% !important;text-align:center !important;"><?php  echo ' উচ্চমাধ্যমিক ';  //echo $this->lang->line('LAST_SEVEN_DAYS_TOP_SERVICE_PROVIDER');?></div>
                                    </a>
                                </div>
                                <div id="top_income_lastsevendays" class="metro-nav-block nav-block-dark-green double" style="width:32% !important;">
                                    <a class="click2 external" id="2" href="javascript:void(0);" style=" margin-top:-20px; margin-left: -4px;text-align:center;">
                                        <div class="brand" style="width:100% !important;text-align:center !important;"><?php //echo $this->lang->line('LAST_SEVEN_DAYS_TOP_INCOME');?></div>
                                    </a>
                                </div>

                                <div id="top_service_lastmonth" class="metro-nav-block nav-block-dark-green double" style="width:32% !important;">
                                    <a class="click external" id="3" href="javascript:void(0);" style=" margin-top:-20px; margin-left: -4px; text-align:center;">
                                        <div class="brand" style="width:100% !important;text-align:center !important;"><?php //echo $this->lang->line('LAST_MONTH_TOP_SERVICE_PROVIDER');?></div>
                                    </a>
                                </div>
                                <div id="top_income_lastmonth" class="metro-nav-block nav-block-dark-green double" style="width:32% !important;">
                                    <a class="click2 external" id="3" href="javascript:void(0);" style=" margin-top:-20px; margin-left: -4px;text-align:center;">
                                        <div class="brand" style="width:100% !important;text-align:center !important;"><?php //echo $this->lang->line('LAST_MONTH_TOP_INCOME');?></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="wrapper">
        <ul class="stats">
            <li class="li-tab">
                <div style="font-family:nikoshBan;" class="left margin-left-top">
                    <h4 style="font-family:nikoshBan;color:#900;">বরিশাল&nbsp;</h4>

                </div>
                <div class="chart" style=" float:right; margin-top:0px;">
                    <span class="right_top_box" style="color:#900;"> 10000</span>
                </div>
            </li>
            <li class="li-tab">
                <div style="font-family:nikoshBan;" class="left margin-left-top">
                    <h4 style="font-family:nikoshBan;color:#8E52A0;">চট্টগ্রাম <?php //echo Website_helper::get_total_income_today(); ?></h4>

                </div>
                <div class="chart" style=" float:right; margin-top:0px;">
                    <span class="right_top_box" style="color:#8E52A0">10000</span>
                </div>
            </li>
            <li class="li-tab">
                <div class="left margin-left-top">
                    <h4 style="font-family:nikoshBan;color:#FFB400;">ঢাকা  <?php //echo Website_helper::get_total_investment(); ?></h4>

                </div>
                <div class="chart" style=" float:right; margin-top:0px;">
                      <span class="right_top_box" style="color:#8E52A0">10000</span>
                </div>
            </li>
            <li class="li-tab">
                <div  style="font-family:nikoshBan;" class="left margin-left-top">
                    <h4 style="font-family:nikoshBan;;color:#0DAED3;">খুলনা<?php //echo Website_helper::get_total_services(); ?>&nbsp;</h4>

                </div>
                <div class="chart" style=" float:right; margin-top:0px;">
                     <span class="right_top_box" style="color:#8E52A0">10000</span>
                </div>
            </li>
            <li class="li-tab">
                <div style="font-family:nikoshBan;" class="left margin-left-top">
                    <h4 style="font-family:nikoshBan;color:#090;">রাজশাহী<?php //echo Website_helper::get_total_entrepreneurs(); ?>&nbsp;</h4>

                </div>
                <div class="chart" style=" float:right; margin-top:0px;">
                     <span class="right_top_box" style="color:#8E52A0">10000</span>
                </div>
            </li>

             <li class="li-tab">
                <div style="font-family:nikoshBan;" class="left margin-left-top">
                    <h4 style="font-family:nikoshBan;color:#090;">রংপুর<?php //echo Website_helper::get_total_entrepreneurs(); ?>&nbsp;</h4>

                </div>
                <div class="chart" style=" float:right; margin-top:0px;">
                     <span class="right_top_box" style="color:#8E52A0">10000</span>
                </div>
            </li>

              <li class="li-tab">
                <div style="font-family:nikoshBan;" class="left margin-left-top">
                    <h4 style="font-family:nikoshBan;color:#090;">সিলেট<?php //echo Website_helper::get_total_entrepreneurs(); ?>&nbsp;</h4>

                </div>
                <div class="chart" style=" float:right; margin-top:0px;">
                      <span class="right_top_box" style="color:#8E52A0">10000</span>
                </div>
            </li>
        </ul>
    </div>

    <hr class="hr-stylish-1">
        <div class="wrapper">
            <div id="scrollbar-two">
                <div class="scrollbar">
                    <div class="track">
                        <div class="thumb">
                            <div class="end">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="viewport">
                    <div class="overview">
                        <div class="featured-articles-container">
                            <h5 class="heading-blue">
                                গুরুত্বপূর্ণ লিঙ্ক
                            </h5>

                            <li class="link_cls">
                            	<a class="external" href="http://www.infokosh.gov.bd/" target="_blank">
                                <table width="100%">
                                	<tr>
                                    	<td width="20%">
                                            <img src="<?php echo base_url() ?>/images/link/if-logo.png" width="36" height="36"/>
                                		</td>
                                        <td width="80%" align="left">
                            	            <span>জাতীয় ই-তথ্য কোষ</span>
                                		</td>
                                	</tr>
                                </table>
                                </a>
                            </li>

                            <li class="link_cls">
                            <a class="external" href="http://forms.portal.gov.bd/" target="_blank">
                            <table width="100%">
                                	<tr>
                                    	<td width="20%">
                            	            <img src="<?php echo base_url() ?>/images/link/form_logo.png" width="36" height="36"/>
                                		</td>
                                        <td width="80%" align="left">
                                            <span>বাংলাদেশ ফরম</span>
                                		</td>
                                	</tr>
                                </table>
                                </a>
                            </li>

                            <li class="link_cls">
                            	<a class="external" href="http://services.portal.gov.bd/" target="_blank">
                                <table width="100%">
                                	<tr>
                                    	<td width="20%">
                                            <img src="<?php echo base_url() ?>/images/link/service_logo.png" width="36" height="36"/>
                                		</td>
                                        <td width="80%" align="left">
                            	            <span>সেবাকুঞ্জ</span>
                                        </td>
                                    </tr>
                                </table>
                                </a>
                            </li>

                            <li class="link_cls">
                            	<a class="external" href="http://www.passport.gov.bd/" target="_blank">
                                <table width="100%">
                                	<tr>
                                    	<td width="20%">
                                            <img src="<?php echo base_url() ?>/images/link/passport.jpg" width="26" height="30"/>
                                		</td>
                                        <td width="80%" align="left">
                            	            <span>পাসপোর্ট আবেদন</span>
                                        </td>
                                    </tr>
                                </table>
                                </a>
                            </li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- TOTAL CONTENT -->
</div>

<!-- TOTAL CONTENT -->
</div><?php */?>
