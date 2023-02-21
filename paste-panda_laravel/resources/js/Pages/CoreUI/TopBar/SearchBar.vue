<template>
    <div style="display: flex; align-items: center; justify-content: center;">
        <svg-icon icon="search-icon" style="font-size: 18px; margin-left: 8px;"></svg-icon>
        <tags-input
            element-id="tags"
            v-model="tagsInput"
            placeholder="Search"
            display-field="foobar"
            @keydown.enter="search"
            :existing-tags="getTags"
            @change="searchForTags"
            :limit="0"
            :typeahead-always-show="true"
            typeahead-style="dropdown"
            :only-existing-tags="true"
            @tag-added="tagAdded"
            :typeahead="true">
            <!--            <template v-slot:selected-tag="{tag}">-->
            <!--                <span v-html="tag.value"></span>-->
            <!--                &lt;!&ndash; <a-->
            <!--                  v-show="!disabled"-->
            <!--                  href="#"-->
            <!--                  class="tags-input-remove"-->
            <!--                  @click.prevent="removeTag(index)"-->
            <!--                ></a> &ndash;&gt;-->
            <!--            </template>-->
        </tags-input>
    </div>
</template>

<script>
import SvgIcon from "../../../CoreUI/Components/SvgIcon";
import TagsInput from "../../../CoreUI/Components/TagsInput";
import SectionsMixin from "../../../mixins/SectionsMixin";
import {mapActions, mapGetters, mapMutations} from "vuex";

export default {
    name: "SearchBar",
    components: {TagsInput, SvgIcon},
    mixins: [SectionsMixin],
    data() {
        return {
            tagsInput: [],
            shouldAddTag: false,
        }
    },
    methods: {
        ...mapMutations(['SET_QUERY', 'EMPTY_TAGS', 'SET_TAGS']),
        ...mapActions(['fetchTags']),
        tagAdded() {
            this.shouldAddTag = false;
            this.EMPTY_TAGS([]);
        },
        searchForTags(query) {
            this.shouldAddTag = true;
            this.fetchTags(query);
        },
        search() {
            if (!this.shouldAddTag) {
                this.SET_QUERY(this.tagsInput.map(o => o.key).join(','));
                
                let params = this.getSearchParams();
                this.performSearch(params);
            }
        },
        setInitialTagsToSearchBar() {
            if (this.hasSearchQuery) {
    
                this.SET_TAGS(this.$page.props.tags);
    
                const tags = this.$page.props.search.split(',');
    
                this.tagsInput = this.getTags.filter(o => {
                    return tags.includes(o.key);
                });
            }
        },
    },
    computed: {
        ...mapGetters(['getTags']),
        hasSearchQuery() {
            return this.$page.props.search;
        }
    },
    created() {
        this.setInitialTagsToSearchBar();
    }
}
</script>
