<template>
		<div>
				<v-app-bar 
						class="indigo darken-4 yellow--text"
						dark
						app
						elevation="0">
						<v-toolbar-title>
								<span>
									<v-img
											max-width="155"
											:src="$api.storageURL + '/storage/images/logo/sepakatlogo.svg'"
											>
										</v-img>
								</span>
						</v-toolbar-title>
						<v-spacer />
						<v-btn to="/" class="mr-2" color="yellow" text large>
								Home
						</v-btn>
						<v-btn to="/about" class="mr-2" color="yellow" text large>
								About
						</v-btn>
						<v-btn to="/login" color="yellow" text large>
								Login
						</v-btn>
				</v-app-bar>
				<v-main>
						<slot/>
				</v-main>  
				<v-footer app padless fixed>
			<v-card class="flex" color="yellow darken-2" flat tile>
				<v-divider></v-divider>
				<v-card-text class="py-2 black--text text-center">
					<strong>{{ namaAPPAlias }} (2020-2021)</strong> dikembangkan oleh LPPM STT INDONESIA TANJUNGPINANG
					<v-btn icon href="https://github.com/mrizkir/sepakat">
						<v-icon>mdi-github</v-icon>
					</v-btn>
				</v-card-text>
			</v-card>
		</v-footer>  
		</div>
</template>
<script>
import { mapGetters } from 'vuex';

export default {
		name: 'FrontLayout',
		created ()
		{
				this.$store.dispatch('uifront/init',this.$ajax);           
		},
		computed : {
				...mapGetters('uifront', {
						namaAPPAlias: 'getNamaAPPAlias'
				})
		}
}
</script>