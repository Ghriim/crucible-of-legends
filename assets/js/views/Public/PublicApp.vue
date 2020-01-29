<template>
    <div>
        <header>
            <nav>
                <ul>
                    <li>
                        <router-link :to="{name: 'registration'}"><a>Registration</a></router-link>
                    </li>
                    <li>
                        <router-link :to="{name: 'login'}"><a>Login</a></router-link>
                    </li>
                </ul>
            </nav>
        </header>

        <section>
            <transition name="fade" mode="out-in">
                <router-view />
            </transition>
        </section>
    </div>
</template>

<script>
    export default {
        name: "PublicApp",
    }
</script>
