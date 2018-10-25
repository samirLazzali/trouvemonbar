<template>
  <v-app id="inspire">
    <v-content>
      <v-container fluid>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4>
            <v-card
                class="mx-auto"
                max-width="500"
              >
                <v-card-title class="title font-weight-regular justify-space-between" color="success">
                  <span>{{ currentTitle }}</span>
                  <v-avatar
                    color="success"
                    class="subheading white--text"
                    size="24"
                    v-text="step"
                  ></v-avatar>
                </v-card-title>

                <v-window v-model="step" color="success">
                  <v-window-item :value="1" color="">
                    <v-card-text>
                      <v-text-field
                        label="Email"
                        value="bernard@gmail.com"
                      ></v-text-field>
                      <span class="caption grey--text text--darken-1">
                       Cette email sera utilisé pour vérifier votre compte.
                      </span>
                    </v-card-text>
                  </v-window-item>

                  <v-window-item :value="2" color="success">
                    <v-card-text>
                      <v-text-field
                        label="Mot de passe"
                        type="password"
                      ></v-text-field>
                      <v-text-field
                        label="Confirmez le mot de passe"
                        type="password"
                      ></v-text-field>
                      <span class="caption grey--text text--darken-1">
                        Veuillez entrer un mot de passe pour votre compte
                      </span>
                    </v-card-text>
                  </v-window-item>

                  <v-window-item :value="3" color="success">
                    <div class="pa-3 text-xs-center">
                      <h3 class="title font-weight-light mb-2">Bienvenue sur votre Trouvetonbar</h3>
                      <span class="caption grey--text">Merci pour votre inscription</span>
                    </div>
                  </v-window-item>
                </v-window>

                <v-divider></v-divider>

                <v-card-actions>
                  <v-btn
                    :disabled="step === 1"
                    flat
                    @click="step--"
                  >
                    Précédant
                  </v-btn>
                  <v-spacer></v-spacer>
                  <v-btn
                    :disabled="step === 3"
                    color="success"
                    depressed
                    @click="step++"
                  >
                    Suivant
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-flex>
          </v-layout>
        </v-container>
      </v-content>
  </v-app>
</template>

<script>


export default {
    name : 'login',
    data: () => ({
      step: 1
    }),

    computed: {
      currentTitle () {
        switch (this.step) {
          case 1: return 'Inscription'
          case 2: return 'Mot de passe'
          default: return 'Inscription réussie'
        }
      }
    }
  }
</script>
