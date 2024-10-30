<?php
// Получаем текущего пользователя
$user = wp_get_current_user();
?>
<div class="block-titles">
                    <div class="cabinet-titles-mobile">
                        <h1 class="open-menu">Персональні дані</h1>
                        <div class="mobile">
                            <ul class="cabinet-menu-mobile  mt-10">
                                <li><a href="#">Мої замовлення</a></li>
                                <li><a href="#">Обрані товари</a></li>
                                <li><a href="#">Товари в очікуванні</a></li>
                            </ul>
                        </div>
                    </div>
                    <script>
                        document.querySelector('.block-titles h1').addEventListener('click', function() {
                            this.classList.toggle('active');
                        });
                    </script>
                </div>


                <div class="information-block personal-discount">
                    <div class="grid-discount">
                        <div class="left-part yellow-bg">
                            <h4 class="title-with-flex">Моя персональна знижка — <span class="title-big"> 10%</span></h4>
                            <a class="small-title-green" style="text-decoration: underline;">Як працює програма лояльності?</a>
                        </div>
                        <div class="right-part">
                            <p class="after-discount-procent">Отримайте знижку 15%, зробивши покупки на загальну суму 20 000 грн</p>
                            <p class="sum-count-products">Сума здійснених покупок - 12 748.90 грн </p>
                        </div>
                    </div>
                </div>




                <div class="information-block">
                    <div class="grid-personal-tables">

                        <div class="table-block">
                            <h3 class="title-with-flex">Особисті дані <img class="edit" src="./icon/edit_square.svg" alt=""></h3>
                            <form  id="update-name-form" method="post">
                            <table class="personal-table mt-20">
                                <tbody>
                                    <tr>
                                        <td>Ім’я</td>
                                        <td> <input type="text" name="first_name" id="first_name" value="<?php echo esc_attr($user->first_name); ?>" required /></td>
                                    </tr>
                                    <tr>
                                        <td>Прізвище</td>
                                        <td><input type="text" name="last_name" id="last_name" value="<?php echo esc_attr($user->last_name); ?>" required /></td>
                                    </tr>
                                    <tr>
                                        <td>Номер телефону</td>
                                        <td><input type="text" name="billing_phone" id="billing_phone" value="<?php echo esc_attr(get_user_meta($user->ID, 'billing_phone', true)); ?>" required /></td>
                                    </tr>
                                </tbody>
                            </table>
                                <button type="submit" id="update-name-button"><?php _e('Обновить данные', 'your-textdomain'); ?></button>
                            </form>
                        </div>

                        <div class="table-block">
                            <h3 class="title-with-flex">Інформація про доставку <img class="edit" src="./icon/edit_square.svg" alt=""></h3>
                            <table class="personal-table mt-20">
                                <tbody>
                                    <tr>
                                        <td>Спосіб доставки</td>
                                        <td>Нова пошта</td>
                                    </tr>
                                    <tr>
                                        <td>Місто</td>
                                        <td>Київ</td>
                                    </tr>
                                    <tr>
                                        <td>Відділення</td>
                                        <td>№15 (вул. Тараса Шевченка, 143)</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
