<template>
    <div class="menu">
        <div class="menu__container">
            <ul :class="{active : visibleMenu}">
                <li>
                    <router-link to="/">
                        <i class="fas fa-project-diagram"></i>
                        Pulpit
                    </router-link>
                </li>
                <li>
                    <a href="#">
                        <i class="far fa-calendar-alt"></i>Kalendarz
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-cog"></i>Administracja
                    </a>
                </li>
                <li>
                    <a href="#" class="highlight">
                        <i class="fas fa-plus-circle"></i>Nowe zgłoszenie
                    </a>
                </li>
            </ul>
            <a href="#" class="menu__logout" @click="logout">
                <i class="fas fa-power-off"></i>
                Wyloguj
            </a>

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
            }
        },
        methods: {
            showMenu() {
                this.visibleMenu = !this.visibleMenu;
                document.body.classList.toggle("overflow");
            },
            logout() {
                this.$store.dispatch('logout')
                    .then(() => {
                        this.$router.push('/login')
                    })
            },

        },


    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";

    .menu {
        background: #f3f3f3;
        padding: 20px 0;

        @media (max-width: $screen-md) {
            position: sticky;
            top: 0;
            z-index: 100;
            padding: 30px 0;
        }

        &__container {
            padding: 0 15px;
            width: 100%;
            max-width: $container;
            margin: 0 auto;
            box-sizing: border-box;
            position: relative;

        }

        ul {
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
                margin-right: 30px;

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
                    font-size: 14px;
                    color: $mainColor;
                    text-decoration: none;
                    transition: color 0.3s, background 0.3s;

                    @media (max-width: $screen-md) {
                        padding: 15px 20px;
                        font-size: 16px;
                        color: #fff;
                    }

                    @media (min-width: $screen-md+1px) {
                        &:hover {

                            color: $mainColorHover;
                        }
                    }

                    @media (max-width: $screen-md) {
                        &:active{
                            color: #fff;
                            background: rgba(255, 255, 255, 0.15);
                    }
                }

                &.highlight {
                    color: $highlightColor;
                    @media (max-width: $screen-md) {
                        color: #fff;
                    }

                    &:hover {
                        color: $highlightColorHover;
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
                    font-weight: bold;
                    color: $mainColorHover;

                    @media (max-width: $screen-md) {
                        color: #fff;
                        font-weight: 400;
                        background: rgba(255, 255, 255, 0.15);
                    }

                }
            }
        }
    }

    &__logout {
        display: flex;
        align-items: center;
        font-size: 14px;
        color: $mainColor;
        text-decoration: none;
        transition: color 0.3s;
        position: absolute;
        top: 0;
        right: 15px;
        bottom: 0;
        margin: auto;

        @media (max-width: $screen-md) {
            font-size: 18px;
        }

        &:hover {
            color: $mainColorHover;
        }

        i {
            margin-right: 7px;
            font-size: 16px;
            @media (max-width: $screen-md) {
                font-size: 20px;
            }

        }

    }

    }

    .menuButton {
        width: 40px;
        flex-direction: column;
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        margin: auto;
        height: 30px;
        display: none;
        transition: left 0.3s ease-in-out;
        z-index: 100;

        @media (max-width: $screen-md) {
            display: flex;
        }

        &.active {
            left: 200px;
            top: 20px;


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
            height: 4px;
            background: $mainColor;
            margin-bottom: 7px;
            transition: transform 0.3s, opacity 0.3s;

            &:last-child {
                margin-bottom: 0;
            }
        }
    }
</style>
