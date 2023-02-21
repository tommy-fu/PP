<template>
	<div>
		<sidebar-accordion-item title="Custom palette" :label="true">
			<div>
				<div class="body-lg mb-8 color-636363" style="margin-bottom: 12px;">Enter hex value</div>
				<div class="primary-input"
				     @click="setFocusOnColorInput"
				     :style="getPrimaryInputStyle">
					<div class="color-pick mr-12" :style="'background: ' + hexValue"></div>
					<input class="body-lg no-wrap color-636363 mr-12 color-input" placeholder="#00000"
					       style="background: transparent; outline: none; border: none; width: 100%;"
					       ref="colorInput"
					       @focus="inputFocused = true"
					       @focusout="inputFocused = false"
					       @keyup.enter="generateScheme" v-model="hex">
				</div>
				<p style="color: rgb(241, 70, 104); font-size: 14px;" v-if="$page.props.errors.hex">
					{{$page.props.errors.hex}}</p>
				
				<div v-if="$page.props.auth.user.generated_theme">
					<div class="body-lg mb-8 color-636363 mt-24" style="margin-bottom: 12px;">Backgrounds</div>
					<div class="colortheme-item"
					     :class="{'colortheme-item--active' : $page.props.auth.user.generated_theme.id === $page.props.auth.user.color_scheme_set_id}"
					>
						<!--						<div class="colortheme-bottom">-->
						<div class="colortheme-bottom" style="justify-content: space-between; width: 100%;">
							<div style="cursor: pointer; width: 100%; display: flex; justify-content: space-between;"
							     v-for="chunk in getThemeChunks($page.props.auth.user.generated_theme)">
								
								<div v-for="scheme in chunk">
									<div v-if="scheme.hide"
									     class="palette-wrapper" style="border: 1px solid transparent"></div>
									<div class="palette-wrapper"
									     :class="{'palette-wrapper--active' : scheme.id === $page.props.auth.user.color_scheme_id}"
									     @click="selectScheme(scheme.id)" v-else>
										<div class="color" style="width: 24px; height: 24px; border-radius: 5px;"
										     :style="'background: ' + scheme.colors.bg"></div>
									</div>
								
								</div>
							</div>
						</div>
					</div>
				</div>
			
			</div>
		</sidebar-accordion-item>
		
		<sidebar-accordion-item title="Palette library">
			<!-- COLORS -->
			<div class="colortheme-item" v-for="theme in $page.props.color_themes"
			     :class="{'colortheme-item--active' : theme.id === $page.props.auth.user.color_scheme_set_id}">
				<div class="colortheme-top">
					<div class="body-sm color-fff body-sm--inactive">{{theme.name}}</div>
				</div>
				<div class="colortheme-bottom" style="justify-content: space-between; width: 100%;">
					<div style="cursor: pointer; width: 100%; display: flex; justify-content: space-between;"
					     v-for="chunk in getThemeChunks(theme)">
						
						<div v-for="scheme in chunk" style="margin-top: 12px;">
							<div v-if="scheme.hide" class="palette-wrapper" style="border: 1px solid transparent"></div>
							<div class="palette-wrapper"
							     :class="{'palette-wrapper--active' : scheme.id === $page.props.auth.user.color_scheme_id}"
							     @click="selectScheme(scheme.id)" v-else>
								<div class="palette-inner-wrapper">
									<div class="palette-color bg-temp-color-1"
									     :style="'background: ' + scheme.colors.bg_1"></div>
									<div class="palette-inner-right">
										<div class="palette-color bg-temp-color-2"
										     :style="'background: ' + scheme.colors.bg_2"></div>
										<div class="palette-color bg-temp-color-3"
										     :style="'background: ' + scheme.colors.bg_3"></div>
									</div>
									<div class="palette-inner-bottom">
										<div class="palette-color bg-temp-color-3"
										     :style="'background: ' + scheme.colors.bg_4"></div>
										<div class="palette-color bg-temp-color-4"
										     :style="'background: ' + scheme.colors.bg_5"></div>
										<div class="palette-color bg-temp-color-5"
										     :style="'background: ' + scheme.colors.bg_6"></div>
									</div>
								</div>
							</div>
						
						</div>
					</div>
				</div>
			</div>
		</sidebar-accordion-item>
	
	</div>
</template>


<script>
    import {mapGetters} from "vuex";
    import SidebarAccordionItem from "../CoreUI/Components/SidebarAccordionItem";

    export default {
        name: 'color-item',
        components: {SidebarAccordionItem},
        data() {
            return {
                hex: '',
                inputFocused: false
            }
        },
        methods: {
            setFocusOnColorInput() {
                this.$refs.colorInput.focus();
            },
            selectScheme(schemeId) {
                this.$inertia.put('/user-color-schemes/' + schemeId);
            },
            generateScheme() {
                this.$inertia.post('/color-schemes/', {
                    'hex': this.hex.includes('#') ? this.hex : '#' + this.hex
                });
            },
            getThemeChunks(theme) {
                var chunks = this.chunkArray(theme.color_schemes, 4);

                var lastItem = chunks[chunks.length - 1];

                var difference = 4 - lastItem.length;

                for (let i = 0; i < difference; i++) {
                    chunks[chunks.length - 1].push({
                        'hide': true
                    });
                }

                return chunks;
            },
            chunkArray(myArray, chunk_size) {
                var index = 0;
                var arrayLength = myArray.length;
                var tempArray = [];

                for (index = 0; index < arrayLength; index += chunk_size) {
                    var myChunk = myArray.slice(index, index + chunk_size);
                    // Do something if you want with the group
                    tempArray.push(myChunk);
                }

                return tempArray;
            }
        },
        computed: {
            // ...mapGetters(['getColorThemes', 'getActiveColorThemeId', '$page.props.auth.user']),
            hexValue() {
                if (this.hex.includes('#')) return this.hex;

                return '#' + this.hex
            },
            getPrimaryInputStyle() {
                if (this.$page.props.errors.hex) return 'border: 1px solid rgb(241, 70, 104)';
                if (this.inputFocused) return 'border: 1px solid #4d4d4d;';


                return '';
            }
        },
    }
</script>

<style scoped lang="scss">
	
	.color-pick {
		width: 18px;
		height: 16px;
		margin-bottom: 1px;
		border-radius: 2px;
		background-color: #2f2f2f;
	}
	
	.colortheme-item {
		display: flex;
		margin: 16px 0px;
		padding: 16px;
		flex-direction: column;
		justify-content: center;
		align-items: flex-start;
		/*border: 1px solid #2d2d2d;*/
		border: 1px solid #262626;
		border-radius: 6px;
		margin-top: 0;
	}
	
	.colortheme-item.colortheme-item--active {
		border-style: solid;
		border-color: #1592ff;
		background-color: #212121;
	}
	
	.colortheme-top {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100%;
		-webkit-box-pack: justify;
		-webkit-justify-content: space-between;
		-ms-flex-pack: justify;
		justify-content: space-between;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		border-bottom-color: #262626;
	}
	
	.colortheme-bot {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
	}
	
	.colortheme-bottom {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-pack: justify;
		-webkit-justify-content: space-between;
		-ms-flex-pack: justify;
		justify-content: space-between;
		-webkit-flex-wrap: wrap;
		-ms-flex-wrap: wrap;
		flex-wrap: wrap;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
	}
	
	.palette-container {
		position: relative;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 24px;
		height: 24px;
		margin-right: 16px;
		-webkit-flex-wrap: wrap;
		-ms-flex-wrap: wrap;
		flex-wrap: wrap;
		border-radius: 4px;
		box-shadow: 0 0 1px 1px hsla(0, 0%, 100%, 0.75);
	}
	
	.palette-color {
		width: 8px;
		height: 8px;
		background-color: #565656;
	}
	
	.palette-color.palette-color--top-left {
		border-top-left-radius: 4px;
		background-color: #faf9f5;
	}
	
	.palette-color.palette-color--top-right {
		border-top-right-radius: 4px;
		background-color: #ac4027;
	}
	
	.palette-color.palette-color--bottom-left {
		border-bottom-left-radius: 4px;
		background-color: #de6b51;
	}
	
	.palette-color.palette-color--bottom-right {
		border-bottom-right-radius: 4px;
		background-color: #591f11;
	}
	
	.palette-color.bg-temp-color-1 {
		width: 16px;
		height: 16px;
	}
	
	.palette-color.bg-temp-color-2 {
		background-color: #67727e;
	}
	
	.palette-color.bg-temp-color-4 {
		background-color: #7b9ea8;
	}
	
	.palette-color.bg-temp-color-5 {
		background-color: #536c95;
	}
	
	.colortheme-wrapper {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		height: 100%;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-webkit-flex-direction: column;
		-ms-flex-direction: column;
		flex-direction: column;
	}
	
	.palette-wrapper {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 40px;
		height: 40px;
		/*margin-top: 12px;*/
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		border: 1px solid #383838;
		border-radius: 10px;
		-webkit-transition: border-color 50ms ease-in;
		transition: border-color 50ms ease-in;
		/*margin-right: 12px;*/
	}
	
	.palette-wrapper:hover {
		border-color: #fff;
	}
	
	.palette-wrapper.palette-wrapper--active {
		border-color: #1592ff;
		cursor: default;
	}
	
	.palette-inner-wrapper {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		overflow: hidden;
		width: 24px;
		height: 24px;
		-webkit-flex-wrap: wrap;
		-ms-flex-wrap: wrap;
		flex-wrap: wrap;
		border-radius: 5px;
	}
	
	.bg-temp-color-1 {
		background-color: #fff;
	}
	
	.bg-temp-color-2 {
		background-color: #201a12;
	}
	
	.bg-temp-color-3 {
		background-color: #cdcecc;
	}
	
	.bg-temp-color-4 {
		background-color: #2f1e17;
	}
	
	.palette-inner-bottom {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
	}
	
	.primary-input {
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100%;
		height: 40px;
		padding-right: 12px;
		padding-left: 12px;
		-webkit-box-pack: start;
		-webkit-justify-content: flex-start;
		-ms-flex-pack: start;
		justify-content: flex-start;
		-webkit-box-align: center;
		-webkit-align-items: center;
		-ms-flex-align: center;
		align-items: center;
		border: 1px solid #242424;
		border-radius: 6px;
		background-color: #242424;
	}
	
	.primary-input:active {
		border: 1px solid #4d4d4d;
	}
	
	.primary-input.min-width-160 {
		min-width: 160px;
	}
	
	.primary-input.min-width-160.mr-12:focus {
		border-color: #4d4d4d;
	}


</style>
