<footer class="footer overflow-hidden text-[14px]">
    <div class="bottom-header max-[768px]:hidden">
        <div class="header-main-menu">
            <!-- block header_menu_large -->

            <div class="header-menu-large">
                <?php wp_nav_menu(
                    array(
                        'theme_location' => 'mainmenu',
                        'menu_class' => 'nav-menu',
                        'container' => 'main-menu-container'
                    )
                ); ?>
            </div>

        </div>
    </div>

    <div class="content-footer px-[10%] mx-auto flex flex-wrap justify-between py-[30px] max-[768px]:p-[15px]">
        <div class="logo w-[15%] max-[768px]:w-full max-[768px]:mb-[20px]">
            <?php echo get_field('footer_info', 'option')['block_logo']; ?>
        </div>

        <div class="address w-[35%] max-[768px]:w-full max-[768px]:mb-[20px]">
            <?php echo get_field('footer_info', 'option')['block_address']; ?>
        </div>

        <div class="contact w-[20%] max-[768px]:w-full max-[768px]:mb-[20px]">
            <?php echo get_field('footer_info', 'option')['block_contact']; ?>
        </div>

        <div class="info w-[25%] max-[768px]:w-full max-[768px]:mb-[20px]">
            <?php echo get_field('footer_info', 'option')['block_info']; ?>
        </div>
    </div>

    <div class="policy px-[10%] bg-[#ddd] py-[5px]">
        <a href="<?php echo get_field('footer_info', 'option')['chinh_sach']['link']; ?>"><?php echo get_field('footer_info', 'option')['chinh_sach']['text']; ?></a>
    </div>

</footer><!-- End footer -->

</div>

<div id="bttop" class="hidden fixed bottom-[20px] right-[20px] bg-[#a73526] text-[#fff] w-[30px] h-[30px] flex justify-center items-center cursor-pointer"><i class="fa fa-chevron-up"></i></div>

<?php wp_footer(); ?>
</body>

</html>