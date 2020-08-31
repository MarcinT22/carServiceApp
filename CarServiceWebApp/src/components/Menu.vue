<template>
    <div class="menu">
        <div class="menu__container">
            <ul :class="{active : visibleMenu}" class="menu__main">
                <li>
                    <router-link :to="{name:'Home'}">
                        Pulpit
                    </router-link>
                </li>
                <li>
                    <router-link :to="{name:'CarDeliveriesCalendar'}">
                        Kalendarz przyjęć
                    </router-link>
                </li>
                <li>
                    <router-link :to="{name:'RepairCalendar'}">
                        Kalendarz napraw
                    </router-link>
                </li>
                <li>
                    <router-link :to="{name:'NewReportedCar'}" class="highlight">
                        <i class="fas fa-plus-circle"></i>Nowe zgłoszenie
                    </router-link>
                </li>
            </ul>
            <div class="menu__right">
                <ul>
                    <li v-if="isAdmin">
                        <router-link :to="{name:'Settings'}" class="menu__icon">
                            <i class="fas fa-cog"></i>
                        </router-link>
                    </li>
                    <li>
                        <a href="#" class="menu__icon" @click="logout">
                            <i class="fas fa-power-off"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <a href="#" class="menuButton" :class="{active:visibleMenu}" v-on:click.prevent="showMenu">
            <span></span>
            <span></span>
            <span></span>
        </a>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        name: "Menu",
        data() {
            return {
                visibleMenu: false,
                isAdmin:JSON.parse(localStorage.getItem('user')).is_admin
            }
        },
        methods: {
            showMenu() {
                this.visibleMenu = !this.visibleMenu;
                document.body.classList.toggle("overflow");
            },
            closeMenu()
            {
                this.visibleMenu = false;
                document.body.classList.remove("overflow");
            },
            logout() {
                this.$store.dispatch('logout')
                    .then(() => {
                        this.$router.push('/login')
                    })
            },

        },
        watch: {
            $route () {
               this.closeMenu()
            }
        }


    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";

    .menu {
        background: #fff;
        padding: 15px 0;
        box-shadow:0 0 20px 0 rgba(100,100,100,0.1);
        position: sticky;
        top: 0;
        z-index: 2;
        @media (max-width: $screen-md) {
            padding: 25px 0;
        }

        &__container {
            padding: 0 15px;
            width: 100%;
            max-width: $container;
            margin: 0 auto;
            box-sizing: border-box;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;

        }


        ul.menu__main {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;

            @media (max-width: $screen-md) {
                width: 250px;
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                background: url("../assets/image/login-background.jpg") no-repeat;
                background-size: cover;
                background-position: center center;
                box-shadow: 0 0 15px 0 rgba(0, 0, 0, 0.2);
                display: block;
                padding: 55px 0px;
                box-sizing: border-box;
                transition: left 0.3s ease-in-out;
                left: -270px;
                overflow-y: auto;
                padding-bottom: 100px;
                z-index: 100;



                &.active {
                    left: 0;
                }
            }

            li {
                margin-right: 5px;

                @media (max-width: $screen-md) {
                    width: 100%;
                    margin: 0;
                    margin-bottom: 5px;
                }

                &:last-child {
                    margin-right: 0;
                }

                a {
                    display: flex;
                    align-items: center;
                    font-size: 13px;
                    color:$menuTextColor;
                    text-decoration: none;
                    transition: color 0.3s, background 0.3s;
                    padding:13px 20px;
                    line-height: 100%;
                    font-weight: 500;
                    border-radius: 4px;
                    box-sizing: border-box;

                    @media (max-width: $screen-md) {
                        padding: 15px 15px;
                        font-size: 16px;
                        color: #fff;
                    }

                    @media (min-width: $screen-md+1px) {
                        &:hover {

                            color: $mainColor;
                            background: $lightMainColor;
                        }

                        &:active{
                            background: darken($lightMainColor, 10%) !important;
                        }
                    }

                    @media (max-width: $screen-md) {
                        &:active{
                            color: #fff;
                            background: rgba(255, 255, 255, 0.15);
                    }
                }

                &.highlight {
                    color: $mainColor;
                    @media (max-width: $screen-md) {
                        color: #fff;
                    }

                    &:hover {
                        @media (max-width: $screen-md) {
                            color: #fff;
                        }
                    }
                }

                i {
                    margin-right: 7px;
                    font-size: 16px;

                    @media (max-width: $screen-md) {
                        font-size: 20px;

                    }
                }

                &.active {
                    color: $mainColor;
                    background: $lightMainColor;

                    @media (max-width: $screen-md) {
                        color: #fff;
                        font-weight: 400;
                        background: rgba(255, 255, 255, 0.15);
                    }

                }
            }
        }
    }

        &__right{


            @media (max-width:$screen-md)
            {
                position: absolute;
                right:10px;
            }

            ul{
                display: flex;
                align-items: center;
                padding:0;
                list-style-type: none;
                margin:0;

                li{
                    margin-left:5px;
                    a{
                        display: flex;
                        align-items: center;
                        font-size: 13px;
                        color:$menuTextColor;
                        text-decoration: none;
                        transition: color 0.3s, background 0.3s;
                        padding:13px 20px;
                        line-height: 100%;
                        font-weight: 500;
                        border-radius: 4px;
                        box-sizing: border-box;
                        @media (min-width: $screen-md+1px) {
                            &:hover {
                                color: $mainColor;
                                background: $lightMainColor;
                            }
                        }

                        @media (max-width:$screen-md)
                        {
                            &:active {
                                color: $mainColor;
                                background: $lightMainColor;
                            }
                        }


                        i{
                            margin-right: 7px;
                            font-size: 16px;
                        }
                    }
                }
            }
        }

        &__icon{
            width:42px;
            height:42px;
            border-radius: 100% !important;
            justify-content: center;

            i{
                margin-right: 0 !important;
            }



            @media (min-width: $screen-md+1px) {
                &:hover {

                    color: $mainColor !important;
                    background: $lightMainColor !important;
                }

                &:active{
                    background: darken($lightMainColor, 10%) !important;
                }
            }

            @media (max-width: $screen-md) {
                &:active {
                    color: $mainColor !important;
                    background: $lightMainColor !important;
                }
            }


        }


    }

    .menuButton {
        width: 30px;
        flex-direction: column;
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        margin: auto;
        height: 20px;
        display: none;
        transition: left 0.3s ease-in-out;
        z-index: 100;

        @media (max-width: $screen-md) {
            display: flex;
        }

        &.active {
            left: 210px;
            top: 15px;


            span {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                margin: 0 auto;
                background: #fff;

                &:nth-child(1) {
                    transform: rotate(45deg);
                }

                &:nth-child(2) {
                    opacity: 0;
                }

                &:nth-child(3) {
                    transform: rotate(-45deg);
                }

            }

        }

        span {
            height: 3px;
            background: $mainColor;
            margin-bottom: 5px;
            transition: transform 0.3s, opacity 0.3s;

            &:last-child {
                margin-bottom: 0;
            }
        }
    }
</style>
