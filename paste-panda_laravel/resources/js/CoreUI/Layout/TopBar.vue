<template>
    <div class="navbar">
        <div style="height: 60px">
            <div class="sidebar-nav">
                <a href="/">
                    <img src="/kitspring_text.svg" alt="">
                </a>
                <user-dropdown></user-dropdown>
            </div>
            <div>
                <div style="border-bottom: 1px solid #262626"></div>
            </div>
        </div>
        <div class="vertical-divider full-height"></div>
        <div class="top-bar-settings" style="border-bottom: 1px solid #262626">
            <div class="navbar-left">
                <SearchBar></SearchBar>
            </div>
            <div class="navbar-right">
                <search-filter></search-filter>
                <div style="width: 1px; height: 40px; background: #2A2B2C; margin-right: 20px;"></div>
                <section-type-dropdown></section-type-dropdown>
                <ViewportButtons></ViewportButtons>
            </div>
        </div>
    </div>
</template>

<script>
import SearchFilter from "../../Pages/CoreUI/TopBar/SearchFilter";
import SectionTypeDropdown from "../../Pages/CoreUI/TopBar/SectionTypeDropdown";
import ViewportButtons from "../../Pages/CoreUI/TopBar/ViewportButtons";
import SearchBar from "../../Pages/CoreUI/TopBar/SearchBar";
import UserDropdown from "../../Pages/CoreUI/TopBar/UserDropdown";

export default {
    name: "TopBar",
    components: {
        UserDropdown,
        SearchBar,
        ViewportButtons,
        SectionTypeDropdown,
        SearchFilter,
    },
};
</script>

