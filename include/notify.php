<!-- BEGIN: Top Bar -->
<div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">Application</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active"><?php echo $_GET['a'];?></a> </div>
                    <!-- END: Breadcrumb -->
                    <!-- BEGIN: Search -->
                    <div class="intro-x relative mr-3 sm:mr-6">
                        <div class="search hidden sm:block">
                            <input type="text" class="search__input input placeholder-theme-13" id="search" placeholder="Search..." value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
                            <i data-feather="search" onclick="search();" class="search__icon dark:text-gray-300"></i> 
                        </div>
                        <div class="search-result">
                            <div class="search-result__content">
                                <div class="search-result__content__title">พันธุ์สัตว์</div>
                                <div class="mb-5">
                                    <a href="<?php echo $website;?>/search/ไซบีเรียน" class="flex items-center">
                                        <div class="w-8 h-8 bg-theme-17 text-theme-9 flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-feather="search"></i> </div>
                                        <div class="ml-3">ไซบีเรียน</div>
                                    </a>
                                    <a href="<?php echo $website;?>/search/เปอร์เซีย" class="flex items-center mt-2">
                                        <div class="w-8 h-8 bg-theme-17 text-theme-9 flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-feather="search"></i> </div>
                                        <div class="ml-3">เปอร์เซีย</div>
                                    </a>
                                    <a href="<?php echo $website;?>/search/โกลเด้น" class="flex items-center mt-2">
                                        <div class="w-8 h-8 bg-theme-17 text-theme-9 flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-feather="search"></i> </div>
                                        <div class="ml-3">โกลเด้น</div>
                                    </a>
                                </div>
                                <div class="search-result__content__title">จังหวัด</div>
                                <div class="mb-5">
                                    <a href="<?php echo $website;?>/search/กรุงเทพ" class="flex items-center mt-2">
                                        <div class="w-8 h-8 bg-theme-14 text-theme-7 flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-feather="search"></i> </div>
                                        <div class="ml-3">กรุงเทพ</div>
                                    </a>
                                    <a href="<?php echo $website;?>/search/ขอนแก่น" class="flex items-center mt-2">
                                        <div class="w-8 h-8 bg-theme-14 text-theme-7 flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-feather="search"></i> </div>
                                        <div class="ml-3">ขอนแก่น</div>
                                    </a>
                                    <a href="<?php echo $website;?>/search/อุดร" class="flex items-center mt-2">
                                        <div class="w-8 h-8 bg-theme-14 text-theme-7 flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-feather="search"></i> </div>
                                        <div class="ml-3">อุดร</div>
                                    </a>
                                    <a href="<?php echo $website;?>/search/นนทบุรี" class="flex items-center mt-2">
                                        <div class="w-8 h-8 bg-theme-14 text-theme-7 flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-feather="search"></i> </div>
                                        <div class="ml-3">นนทบุรี</div>
                                    </a>
                                </div>
                                <div class="search-result__content__title">ตำบล</div>
                                    <a href="<?php echo $website;?>/search/บ้านเลื่อม" class="flex items-center mt-2">
                                        <div class="w-8 h-8 bg-theme-16 text-theme-8 flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-feather="search"></i> </div>
                                        <div class="ml-3">บ้านเลื่อม</div>
                                    </a>
                                    <a href="<?php echo $website;?>/search/คลองสาน" class="flex items-center mt-2">
                                        <div class="w-8 h-8 bg-theme-16 text-theme-8 flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-feather="search"></i> </div>
                                        <div class="ml-3">คลองสาน</div>
                                    </a>
                                    <a href="<?php echo $website;?>/search/ศิลา" class="flex items-center mt-2">
                                        <div class="w-8 h-8 bg-theme-16 text-theme-8 flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-feather="search"></i> </div>
                                        <div class="ml-3">ศิลา</div>
                                    </a>
                            </div>
                        </div>
                    </div>
                    <!-- END: Search -->
                    <?php
                    if(isset($_SESSION['uid'])){
                    ?>
                    <!-- BEGIN: Notifications -->
                    <div class="intro-x dropdown relative mr-auto sm:mr-6">
                        <div class="dropdown-toggle notification notification--bullet cursor-pointer"> <i data-feather="bell" class="notification__icon dark:text-gray-300"></i> </div>
                        <div class="notification-content dropdown-box mt-8 absolute top-0 left-0 sm:left-auto sm:right-0 z-20 -ml-10 sm:ml-0">
                            <div class="notification-content__box dropdown-box__content box dark:bg-dark-6">
                                <div class="notification-content__title">Notifications</div>
                                <div class="cursor-pointer relative flex items-center ">
                                    <div class="w-12 h-12 flex-none image-fit mr-1">
                                        <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="<?php echo $website;?>/dist/images/profile-13.jpg">
                                        <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                                    </div>
                                    <div class="ml-2 overflow-hidden">
                                        <div class="flex items-center">
                                            <a href="javascript:;" class="font-medium truncate mr-5">Al Pacino</a> 
                                            <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">05:09 AM</div>
                                        </div>
                                        <div class="w-full truncate text-gray-600">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 20</div>
                                    </div>
                                </div>
                                <div class="cursor-pointer relative flex items-center mt-5">
                                    <div class="w-12 h-12 flex-none image-fit mr-1">
                                        <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="<?php echo $website;?>/dist/images/profile-4.jpg">
                                        <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                                    </div>
                                    <div class="ml-2 overflow-hidden">
                                        <div class="flex items-center">
                                            <a href="javascript:;" class="font-medium truncate mr-5">Keanu Reeves</a> 
                                            <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">01:10 PM</div>
                                        </div>
                                        <div class="w-full truncate text-gray-600">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomi</div>
                                    </div>
                                </div>
                                <div class="cursor-pointer relative flex items-center mt-5">
                                    <div class="w-12 h-12 flex-none image-fit mr-1">
                                        <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="<?php echo $website;?>/dist/images/profile-15.jpg">
                                        <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                                    </div>
                                    <div class="ml-2 overflow-hidden">
                                        <div class="flex items-center">
                                            <a href="javascript:;" class="font-medium truncate mr-5">Brad Pitt</a> 
                                            <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">01:10 PM</div>
                                        </div>
                                        <div class="w-full truncate text-gray-600">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomi</div>
                                    </div>
                                </div>
                                <div class="cursor-pointer relative flex items-center mt-5">
                                    <div class="w-12 h-12 flex-none image-fit mr-1">
                                        <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="<?php echo $website;?>/dist/images/profile-14.jpg">
                                        <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                                    </div>
                                    <div class="ml-2 overflow-hidden">
                                        <div class="flex items-center">
                                            <a href="javascript:;" class="font-medium truncate mr-5">Arnold Schwarzenegger</a> 
                                            <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">05:09 AM</div>
                                        </div>
                                        <div class="w-full truncate text-gray-600">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500</div>
                                    </div>
                                </div>
                                <div class="cursor-pointer relative flex items-center mt-5">
                                    <div class="w-12 h-12 flex-none image-fit mr-1">
                                        <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="<?php echo $website;?>/dist/images/profile-9.jpg">
                                        <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                                    </div>
                                    <div class="ml-2 overflow-hidden">
                                        <div class="flex items-center">
                                            <a href="javascript:;" class="font-medium truncate mr-5">Kevin Spacey</a> 
                                            <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">05:09 AM</div>
                                        </div>
                                        <div class="w-full truncate text-gray-600">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 20</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Notifications -->
                    <!-- BEGIN: Account Menu -->
                    
                    <div class="intro-x dropdown w-8 h-8 relative">
                        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                            <img alt="Midone Tailwind HTML Admin Template" src="<?php echo $website;?>/uploads/<?php echo $user['profile_img'];?>.jpg">
                        </div>
                        <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                            <div class="dropdown-box__content box bg-theme-38 dark:bg-dark-6 text-white">
                                <div class="p-4 border-b border-theme-40 dark:border-dark-3">
                                    <div class="font-medium"><?php echo $user['name'];?></div>
                                    <div class="text-xs text-theme-41 dark:text-gray-600">Backend Engineer</div>
                                </div>
                                <div class="p-2">
                                    <a href="<?php echo $website;?>/settings/profile" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> โปรไฟล์ </a>
                                    <a href="<?php echo $website;?>/settings/repassword" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="lock" class="w-4 h-4 mr-2"></i> เปลี่ยนรหัส </a>
                                    <a href="<?php echo $website;?>/settings/reprofile" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="camera" class="w-4 h-4 mr-2"></i> เปลี่ยนรูปโปรไฟล์ </a>
                                    <a href="<?php echo $website;?>/history" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="package" class="w-4 h-4 mr-2"></i> ประวัติการโพสต์ </a>
                                </div>
                                <div class="p-2 border-t border-theme-40 dark:border-dark-3">
                                    <a href="<?php echo $website;?>/logout.php" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                    }else{
                    ?>
                    <a href="<?php echo $website;?>/login" class="button text-white bg-theme-1 shadow-md mr-2">เข้าสู่ระบบ</a>
                    <a href="<?php echo $website;?>/register" class="button text-white bg-theme-6 shadow-md mr-2">สมัครสมาชิก</a>
                    <?php } ?>
                    <!-- END: Account Menu -->
                </div>
                <!-- END: Top Bar -->