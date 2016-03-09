(function ()
{
    // create MCShortcodes plugin
    tinymce.create("tinymce.plugins.MCShortcodes",
        {

            init: function ( ed, url )
            {
                var this_url = url;
            },
            createControl: function ( btn, ed )
            {
                if ( btn == "mc_shortcode_button" )
                {
                    var this_obj = this;

                    var btn = ed.createSplitButton('mc_shortcode_button', {
                        title: "Insert MC Shortcode",
                        image: ShortcodeAttributes.shortcode_folder +"/icons/mc.png",
                        icons: false
                    });

                    btn.onRenderMenu.add(function (submenu, menu)
                    {

                        menu.add({
                            title: 'Accordions',
                            onclick: function () {
                                tb_show("Add Accordion", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=accordion&width=700&height=600');
                            }
                        });

                        menu.add({
                            title: 'Buttons',
                            onclick: function () {
                                tb_show("Add Button", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=button&width=700&height=600');
                            }
                        });

                        submenu = menu.addMenu({
                            title: "Boxes"
                        });

                        submenu.add({
                            title: 'Alert Box',
                            onclick: function () {
                                tb_show("Add Alert Box", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=alert&width=400&height=500');
                            }
                        });
                        submenu.add({
                            title: 'Call To Action Box',
                            onclick: function () {
                                tb_show("Add Call To Action Box", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=tagline_box&width=400&height=500');
                            }
                        });
                        submenu.add({
                            title: 'Client Slider Box',
                            onclick: function () {
                                tb_show("Add Client Slider Box", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=testimonials&width=400&height=500');
                            }
                        });
                        submenu.add({
                            title: 'Contact Box',
                            onclick: function () {
                                tb_show("Add Contact Box", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=contact_details&width=400&height=500');
                            }
                        });

                        submenu.add({
                            title: 'Counter Box',
                            onclick: function () {
                                tb_show("Add Counter Box", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=counter&width=400&height=500');
                            }
                        });

                        submenu.add({
                            title: 'Big Counter Box',
                            onclick: function () {
                                tb_show("Add Big Counter Box", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=big_counter&width=400&height=500');
                            }
                        });

                        submenu.add({
                            title: 'Parallax Quote',
                            onclick: function () {
                                tb_show("Add Parallax Quote", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=parallax_quote&width=400&height=500');
                            }
                        });

                        submenu.add({
                            title: 'Recent Posts',
                            onclick: function () {
                                tb_show("Add Recent Posts", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=recent_posts&width=400&height=500');
                            }
                        });
                        submenu.add({
                            title: 'Service Box',
                            onclick: function () {
                                tb_show("Add Service Box", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=service&width=400&height=500');
                            }
                        });

                        submenu.add({
                            title: 'Technology Box',
                            onclick: function () {
                                tb_show("Add Technology Box", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=technologies&width=400&height=500');
                            }
                        });
                        submenu.add({
                            title: 'Tweet Box',
                            onclick: function () {
                                tb_show("Add Tweets Box", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=parallax_twitter&width=400&height=500');
                            }
                        });
                        submenu = menu.addMenu({
                            title: "Columns"
                        });


                        submenu.add({
                            title: 'One Half',
                            onclick: function () {
                                tb_show("Add One Half Column", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=one_half&width=400&height=500');
                            }
                        });

                        submenu.add({
                            title: 'One Third',
                            onclick: function () {
                                tb_show("Add One Third Column", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=one_third&width=400&height=500');
                            }
                        });

                        submenu.add({
                            title: 'One Fourth',
                            onclick: function () {
                                tb_show("Add One Fourth Column", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=one_fourth&width=400&height=500');
                            }
                        });

                        submenu.add({
                            title: 'One Fifth',
                            onclick: function () {
                                tb_show("Add One Fifth Column", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=one_fifth&width=400&height=500');
                            }
                        });

                        submenu.add({
                            title: 'One Sixth',
                            onclick: function () {
                                tb_show("Add One Sixth Column", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=one_sixth&width=400&height=500');
                            }
                        });

                        submenu.add({
                            title: 'Two Third',
                            onclick: function () {
                                tb_show("Add Two Third Column", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=two_third&width=400&height=500');
                            }
                        });

                        submenu.add({
                            title: 'Two Fifth',
                            onclick: function () {
                                tb_show("Add Two Fifth Column", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=two_fifth&width=400&height=500');
                            }
                        });

                        submenu.add({
                            title: 'Three Fourth',
                            onclick: function () {
                                tb_show("Add Three Fourth Column", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=three_fourth&width=400&height=500');
                            }
                        });

                        submenu.add({
                            title: 'Three Fifth',
                            onclick: function () {
                                tb_show("Add Three Fifth Column", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=three_fifth&width=400&height=500');
                            }
                        });

                        submenu.add({
                            title: 'Four Fifth',
                            onclick: function () {
                                tb_show("Add Four Fifth Column", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=four_fifth&width=400&height=500');
                            }
                        });

                        submenu.add({
                            title: 'Five Sixth',
                            onclick: function () {
                                tb_show("Add Five Sixth Column", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=five_sixth&width=400&height=500');
                            }
                        });

                        menu.add({
                            title: 'FontAwesome Icon',
                            onclick: function () {
                                tb_show("Add FontAwesome Icon", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=fontawesome_icon&width=400&height=500');
                            }
                        });

                        submenu = menu.addMenu({
                            title: "Helpers"
                        });

                        this_obj.insertText( submenu, "Text Primary Color","[text_color]ADD TEXT HERE[/text_color]" );
                        this_obj.insertText( submenu, "Title Divider","[title_divider]ADD TITLE HERE[/title_divider]" );

                        menu.add({
                            title: 'Image Group',
                            onclick: function () {
                                tb_show("Add Image Group", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=image_group&width=400&height=500');
                            }
                        });

                        menu.add({
                            title: 'List Styles',
                            onclick: function () {
                                tb_show("Add List Style", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=list_styles&width=400&height=500');
                            }
                        });

                        submenu = menu.addMenu({
                            title: "Media"
                        });

                        submenu.add({
                            title: 'Image',
                            onclick: function () {
                                tb_show("Add Image", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=single_image&width=700&height=600');
                            }
                        });

                        submenu.add({
                            title: 'Youtube Video',
                            onclick: function () {
                                tb_show("Add Youtube Video", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=youtube&width=700&height=600');
                            }
                        });
                        submenu.add({
                            title: 'Vimeo Video',
                            onclick: function () {
                                tb_show("Add Vimeo Video", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=vimeo&width=700&height=600');
                            }
                        });

                        this_obj.insertText( menu, "Pricing Table","[pricing_table][pricing_column icon=\"fa fa-dashboard\" title=\"Standard\"][pricing_price price=\"$19.99\" time=\"Per Month\"][/pricing_price][pricing_row]5 Gb Storage[/pricing_row][pricing_row]Free Live Support[/pricing_row][pricing_row]Unlimited Users[/pricing_row][pricing_footer url=\"\"]Sign Up[/pricing_footer][/pricing_column][/pricing_table]");

                        menu.add({
                            title: 'Progress Bar',
                            onclick: function () {
                                tb_show("Add Progress Bar", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=progress&width=700&height=600');
                            }
                        });

                        menu.add({
                            title: 'Social Sharing Links',
                            onclick: function () {
                                tb_show("Add Social Sharing Link", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=social_icons&width=700&height=600');
                            }
                        });

                        menu.add({
                            title: 'Tabs',
                            onclick: function () {
                                tb_show("Add Tab", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=tabs&width=700&height=600');
                            }
                        });

                        menu.add({
                            title: 'Team Member',
                            onclick: function () {
                                tb_show("Add Team Member", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=team&width=700&height=600');
                            }
                        });

                        menu.add({
                            title: 'Toggles',
                            onclick: function () {
                                tb_show("Add Toggle", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=toggle&width=700&height=600');
                            }
                        });

                        submenu = menu.addMenu({
                            title: "Typo Elements"
                        });


                        submenu.add({
                            title: 'Dropcap',
                            onclick: function () {
                                tb_show("Add Dropcap", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=dropcap&width=700&height=600');
                            }
                        });

                        submenu.add({
                            title: 'Title',
                            onclick: function () {
                                tb_show("Add Title", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=title&width=700&height=600');
                            }
                        });

                        submenu.add({
                            title: 'Small Title',
                            onclick: function () {
                                tb_show("Add Small Title", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=small_title&width=700&height=600');
                            }
                        });

                        
                        this_obj.insertText( submenu, "Breaking Line", "[br]");


                        submenu = menu.addMenu({
                            title: "Portfolio Shortcodes"
                        });

                        submenu.add({
                            title: 'Project Section',
                            onclick: function () {
                                tb_show("Add Project Section", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=project_section&width=700&height=600');
                            }
                        });

                        submenu.add({
                            title: 'Project Slider',
                            onclick: function () {
                                tb_show("Add Project Slider", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=project_slider&width=700&height=600');
                            }
                        });

                        submenu.add({
                            title: 'Project Title',
                            onclick: function () {
                                tb_show("Add Project Title", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=project_title&width=700&height=600');
                            }
                        });

                        submenu.add({
                            title: 'Project URL',
                            onclick: function () {
                                tb_show("Add Project URL", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=project_url&width=700&height=600');
                            }
                        });

                        submenu.add({
                            title: 'Visit Project',
                            onclick: function () {
                                tb_show("Add Visit Project", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup/shortcodes_popup.php?&sc=visit_project&width=700&height=600');
                            }
                        });

                    });

                    return btn;
                }

                return null;
            },
            insertText: function ( ed, title, sc) {
                ed.add({
                    title: title,
                    onclick: function () {
                        tinyMCE.activeEditor.execCommand( "mceInsertContent", false, sc )
                    }
                })
            },
            getInfo: function () {
                return {
                    longname: 'MC Shortcodes',
                    author: 'Ruel Mendoza',
                    authorurl: 'http://microcreatives.com',
                    infourl: 'http://microcreatives.com/',
                    version: "1.0"
                }
            }
        });

    // add NewaveShortcodes plugin
    tinymce.PluginManager.add("MCShortcodes", tinymce.plugins.MCShortcodes);
})();