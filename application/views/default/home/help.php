<?php
$CI =& get_instance();
/**
 * Created by PhpStorm.
 * User: HP-14
 * Date: 11/14/2015
 * Time: 6:32 PM
 */
?>
<div id="system_content" class="system_content_margin">
    <div class="col-md-12 helopage">
        <div class="col-md-2">

        </div>
        <div class="col-md-12">
            <div class="col-md-7">
                <iframe width="640" height="350" frameborder="0"
                        src="https://www.google.com.bd/maps?f=q&amp;source=s_q&amp;hl=bn&amp;geocode=&amp;q=Prime+Minister's+Office,+Old+Airport+Road,+Dhaka,+Dhaka+Division&amp;aq=0&amp;oq=prime+&amp;sll=23.608602,90.350998&amp;sspn=7.866889,15.644531&amp;ie=UTF8&amp;hq=Prime+Minister's+Office,+Old+Airport+Road,+Dhaka,+Dhaka+Division&amp;t=m&amp;ll=23.768152,90.391234&amp;spn=0.006295,0.006295&amp;output=embed"
                        marginwidth="0" marginheight="0" scrolling="no"></iframe>
            </div>
            <div class="col-md-5 heloregistration contactpage">
                <h3>হেল্প ডেস্ক</h3>
                <br/>

                <p>হেল্পলাইন নম্বরঃ
                    <strong>02-9615804</strong>
                </p>

                <p>ই-মেইলঃ
                    <strong><a href="mailto:mmc.bgd@gmail.com">mmc.bgd@gmail.com</a></strong>
                </p>


                <p><strong> একসেস টু ইনফরমেশন (এটুআই) প্রোগ্রাম</strong>
                    <br> প্রধানমন্ত্রীর কার্যালয়
                    <br> পুরাতন সংসদ ভবন, তেজগাঁও, ঢাকা-১২১৫
                </p>

            </div>
            <div class="clearfix"></div>
            <br/>

            <div class="alert alert-danger" role="alert"><p style="text-align: center">অনুগ্রহ করে আপনার শিক্ষা
                    প্রতিষ্ঠানের তথ্য প্রদান করুন</p></div>

            <?php
            echo form_open('home/help');
            ?>
            <table width="100%" border="0">
                <tr valign="top">
                    <td width="30%"><label class="control-label pull-left registrationwidth" style="text-align: left;">
                            <?php echo $CI->lang->line('SCHOOL_NAME'); ?>
                            <span style="color:#FF0000">*</span></label></td>
                    <td width="1%">:</td>
                    <td width="69%" style="text-align: left">
                        <?php
                        $data = array(
                            'name' => 'school_name',
                            'id' => 'school_name',
                            'class' => 'form-control',
                            'placeholder' => $this->lang->line('SCHOOL_NAME'),
                            'size' => '50',
                        );

                        echo form_input($data);
                        ?>
                    </td>
                </tr>
                <tr valign="top">
                    <td><label class="control-label pull-left registrationwidth"
                               style="text-align: left;"><?php echo $CI->lang->line('SCHOOL_EMAIL'); ?><span
                                style="color:#FF0000">*</span></label></td>
                    <td>:</td>
                    <td>
                        <?php
                        $data = array(
                            'name' => 'school_email',
                            'id' => 'school_email',
                            'class' => 'form-control',
                            'placeholder' => $this->lang->line('SCHOOL_EMAIL'),
                            'size' => '50',
                        );

                        echo form_input($data);
                        ?>
                    </td>
                </tr>
                <tr valign="top">
                    <td><label class="control-label pull-left registrationwidth"
                               style="text-align: left;"><?php echo $CI->lang->line('SCHOOL_EM'); ?><span
                                style="color:#FF0000">*</span></label></td>
                    <td>:</td>
                    <td>
                        <?php
                        $data = array(
                            'name' => 'em',
                            'id' => 'em',
                            'class' => 'form-control',
                            'placeholder' => $this->lang->line('SCHOOL_EM'),
                            'size' => '50',
                        );

                        echo form_input($data);
                        ?>
                    </td>
                </tr>
                \
                <tr valign="top">
                    <td><label class="control-label pull-left registrationwidth"
                               style="text-align: left;"><?php echo $CI->lang->line('SCHOOL_MOBILE'); ?><span
                                style="color:#FF0000">*</span></label></td>
                    <td>:</td>
                    <td style="text-align: left">
                        <?php
                        $data = array(
                            'name' => 'school_mobile',
                            'id' => 'school_mobile',
                            'class' => 'form-control',
                            'placeholder' => $this->lang->line('SCHOOL_MOBILE'),
                            'size' => '50',
                        );

                        echo form_input($data);
                        ?>
                    </td>
                </tr>

                <tr valign="top">
                    <td><label class="control-label pull-left registrationwidth" style="text-align: left;">
                            আপনার জিজ্ঞাসা
                            <span style="color:#FF0000">*</span></label></td>
                    <td>:</td>
                    <td style="text-align: left">
                        <?php
                        $data = array(
                            'name' => 'details',
                            'id' => 'details',
                            'rows' => '5',
                            'cols' => '10',
                            'class' => 'form-control',
                        );

                        echo form_textarea($data);
                        ?>
                    </td>
                </tr>

                <tr valign="top">
                    <td><label class="control-label pull-left registrationwidth" style="text-align: left;">ক্যাপচা কোড
                            <span style="color:#FF0000">*</span></label></td>
                    <td>:</td>
                    <td style="text-align: left">
                        <label for="captcha"
                               style=" display: block;margin: 0 auto;"><?php echo $captcha['image']; ?></label><br/>

                        <input class="form-control" placeholder="উপরের কোড লিখুন" type="text" id="userCaptcha"
                               name="userCaptcha"/>

                    </td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td style="text-align: left">

                        <?php

                        echo form_submit('mysubmit', $this->lang->line('SEND_REPORT'), "class='myButton'");
                        ?>
                    </td>
                </tr>
            </table>
            <?php
            echo form_close();

            ?>
        </div>
        <!--
             <strong>   আমাদের সম্পর্কে</strong>
        <br />
                শিক্ষার গুণগত মান নিশ্চিত করতে শিক্ষায় তথ্য ও যোগাযোগ প্রযুক্তির সমন্বয় অপরিহার্য। বিশ্বায়নের যুগে বিশ্বের অন্যান্য দেশের সাথে প্রতিযোগিতায় টিকে থাকার জন্য তথ্য ও যোগাযোগ প্রযুক্তি একটি অন্যতম হাতিয়ার হিসাবে কাজ করে। বাংলাদেশ এই সত্যকে উপলব্ধি করে গত দশক থেকে শিক্ষায় তথ্য ও যোগাযোগ প্রযুক্তির ব্যবহার বৃদ্ধিতে ব্যাপকহারে কাজ করছে। এর ফলে বর্তমানে সারা দেশে শিক্ষা মন্ত্রণালয় এবং প্রাথমিক ও গণশিক্ষা মন্ত্রণালয়ের সহযোগিতায় তেইশ হাজারের বেশি মাল্টিমিডিয়া ক্লাসরুম স্থাপন করা হয়েছে। একটি ল্যাপটপ, ইন্টারনেট মডেম, মাল্টিমিডিয়া প্রোজেক্টর, প্রোজেক্টর স্ক্রিন, সাউন্ড সিস্টেমসহ মাল্টিমিডিয়া ক্লাসরুম শিক্ষার্থীদের আনন্দঘন শিখন পরিবেশ নিশ্চিত করছে। একইসাথে শহর ও গ্রামের শিক্ষা প্রতিষ্ঠানের মধ্যকার প্রযুক্তিগত বৈষম্য নিরসনে মাল্টিমিডিয়া ক্লাসরুম গুরুত্বপূর্ণ ভূমিকা পালন করে চলেছে।
                <br /> <br />
                <strong>     মাল্টিমিডিয়া ক্লাসরুম</strong>
                <br />
                ২০১০ সালে ২৩ জন শিক্ষক নিয়ে শিক্ষককেন্দ্রিক শিখন-শেখানো পরিবেশের পরিবর্তে শিক্ষার্থীবান্ধব পরিবেশ তৈরি করতে সাতটি বিদ্যালয়ে মাল্টিমিডিয়া ক্লাসরুম কার্যক্রম শুরু হয়। জানুয়ারি ২০১১ থেকে ২০১৪ সাল পর্যন্ত তেইশ হাজার মাল্টিমিডিয়া ক্লাসরুম স্থাপন করা হয়েছে এবং ৫৫ হাজারের বেশি প্রাথমিক ও মাধ্যমিক শিক্ষা প্রতিষ্ঠানের শিক্ষককে মাল্টিমিডিয়া ক্লাসরুম ব্যবস্থাপনা ও ডিজিটাল কনটেন্ট তৈরির প্রশিক্ষণ দেয়া হয়েছে। এই প্রশিক্ষণের মাধ্যমে শিক্ষকগণ ডিজিটাল কনটেন্ট ব্যবহার করে কঠিন ও বিমূর্ত বিষয়গুলো সহজে উপস্থাপনের কৌশল আয়ত্ত্ব করেছেন।
                <br /> <br />
                <strong>    শিক্ষক বাতায়ন</strong>
                <br />
                বাংলাদেশের সকল পর্যায়ের শিক্ষকদের একই প্ল্যাটফরমে নিয়ে আসার জন্য ব্রিটিশ কাউন্সিলের সহযোগিতায় এটুআই প্রোগ্রাম শিক্ষক বাতায়ন ওয়েবপোর্টাল তৈরি করেছে। এটা শিক্ষকদের পেশাগত উন্নয়নের জন্য একটা নেটওয়ার্ক হিসাবে কাজ করে। শিক্ষকগণ তাঁদের তৈরিকৃত কনটেন্ট, শিক্ষামূলক ডকুমেন্ট, মতামত, ছবি, ভিডিও এখানে শেয়ার করেন। নভেম্বর ২০১৪ সাল পর্যন্ত প্রায় ৪৩০০০ জন শিক্ষক ‘শিক্ষক বাতায়ন’র সদস্য। দেশের বিভিন্ন প্রান্ত হতে এ পর্যন্ত শিক্ষকগণ প্রায় ২৫০০৭ টি ব্লগপোস্ট এবং প্রায় ১২০০০ ডিজিটাল কনটেন্ট আপলোড করেছেন। শিক্ষকবাতায়নের সদস্য সংখ্যা এবং কনটেন্টের সংখ্যা দিন দিন বেড়েই চলেছে।
                <br /> <br />
                    <strong>     মডেল কনটেন্ট তৈরি</strong>
                <br />
                শিক্ষক বাতায়ন (www.teachers.gov.bd) –থেকে বাছাইকৃত সেরা শিক্ষকগণ এটুআই এর তত্ত্বাবধানে মডেল কনটেন্ট তৈরি করছেন। নির্বাচিত সার্টিফাইড মাস্টার ট্রেইনারদের অধীনে সেরা শিক্ষকগণ প্রাথমিকভাবে ৬ষ্ঠ থেকে ৮ম শ্রেণির ইংরেজি, বিজ্ঞান, গণিত এবং বাংলাদেশ ও বিশ্বপরিচয় বিষয়ের উপর মডেল কনটেন্ট তৈরি করছে। পরবর্তীতে ৬ষ্ঠ থেকে ১০ম শ্রেণি পর্যন্ত বাংলা, আইসিটি, ব্যবসায় শিক্ষা, কর্ম ও জীবনমূখী শিক্ষা, পদার্থ বিজ্ঞান, কৃষি শিক্ষা এবং ধর্ম ও নৈতিক শিক্ষা বিষয়সমূহও মডেল কনটেন্ট তৈরির সাথে যুক্ত হবে। নতুন প্রশিক্ষণপ্রাপ্ত শিক্ষকগণ এই মডেল কনটেন্ট থেকে যেমন সাহায্য পাবেন তেমনি কনটেন্টসমূহের মধ্যে সামঞ্জস্য থাকবে। মডেল কনটেন্টগুলো শিক্ষকদের মানসম্মত কনটেন্ট তৈরিতে সাহায্য করবে।
        ->
            </div>
        </div>
