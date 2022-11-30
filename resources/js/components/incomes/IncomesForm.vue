<template>
    <div>
        <v-card width="full"
                rounded="0"
                class="bg-blue-lighten-3 text-white"
                :title="'Balance'"
                :subtitle="$filters.currency(balance)">
        </v-card>
        <v-card width="full"
                height="full"
                rounded="0"
                class="box-shadow-none pt-10 px-2">
            <v-card-text>
                <v-form
                    ref="form"
                    v-model="valid"
                    lazy-validation>
                    <v-text-field
                        label="Amount"
                        placeholder="Amount"
                        type="text"
                        v-model="deposit_value"
                        :rules="depositValueRules"
                        prepend-icon="mdi-currency-usd">
                        <template v-slot:append>
                            <span class="blue">USD</span>
                        </template>
                    </v-text-field>

                    <v-text-field
                        label="Description"
                        placeholder="Description"
                        type="text"
                        v-model="description"
                        :rules="descriptionValueRules"
                        prepend-icon="mdi-text">
                    </v-text-field>

                    <div class="example-drag">
                        <div class="upload">
                            <ul v-if="files.length">
                                <li v-for="file in files" :key="file.id">
                                    <span>{{ file.name }}</span> -
                                    <span>{{ file.size }}</span> -
                                    <span v-if="file.error">{{ file.error }}</span>
                                    <span v-else-if="file.success">success</span>
                                    <span v-else-if="file.active">active</span>
                                    <span v-else></span>
                                </li>
                            </ul>
                            <ul v-else>
                                <td colspan="7">
                                    <div class="text-center p-5">
                                        <h4>Drop files anywhere to upload<br/>or</h4>
                                        <label for="file" class="btn btn-lg btn-primary">Select Files</label>
                                    </div>
                                </td>
                            </ul>

                            <div v-show="$refs.upload && $refs.upload.dropActive" class="drop-active">
                                <h3>Drop files to upload</h3>
                            </div>

                            <div class="example-btn">
                                <file-upload
                                    @input-file="updatedValue"
                                    post-action="/app/api/v1/upload"
                                    :headers="headers"
                                    :multiple="false"
                                    :drop="true"
                                    :drop-directory="true"
                                    v-model="files"
                                    ref="upload">
                                    <i class="fa fa-plus"></i>
                                    Select files
                                </file-upload>
                                <div class="d-flex justify-center align-baseline" style="gap: 1rem">
                                    <v-btn
                                        v-if="!$refs.upload || !$refs.upload.active"
                                        @click.prevent="$refs.upload.active = true"
                                        size="small"
                                        color="blue"
                                        class="mt-3"
                                        prepend-icon="mdi-cloud-upload">
                                        Start Upload
                                    </v-btn>
                                    <v-btn
                                        v-else @click.prevent="$refs.upload.active = false"
                                        size="small"
                                        color="blue-grey"
                                        class="mt-3"
                                        prepend-icon="mdi-cancel">
                                        Stop Upload
                                    </v-btn>
                                </div>
                            </div>
                        </div>

                    </div>
                </v-form>
            </v-card-text>
        </v-card>
        <div class="form-button px-3">
            <v-btn
                size="large"
                block
                color="blue"
                @click="save()">
                DEPOSIT CHECK
            </v-btn>
        </div>
    </div>

    <v-snackbar
        v-model="snackbar">
        {{ message }}
        <template v-slot:actions>
            <v-btn
                :color="message_type"
                variant="text"
                @click="snackbar = false">
                Close
            </v-btn>
        </template>
    </v-snackbar>
</template>

<script>
import FileUpload from 'vue-upload-component'

export default {
    data: () => ({
        valid: true,
        snackbar: false,
        message: '',
        message_type: 'success',
        deposit_value: '',
        depositValueRules: [
            v => !!v || 'Amount is required',
        ],
        description: '',
        descriptionValueRules: [
            v => !!v || 'Description is required',
        ],
        deposit_voucher_path: '',
        files: [],
    }),
    components: {
        FileUpload
    },
    computed: {
        balance() {
            return 1234545
        },
        headers() {
            return {
                "Authorization": 'Bearer ' + localStorage.getItem('access_token')
            }
        }
    },
    methods: {
        updatedValue(newFile, oldFile) {
            if (newFile && oldFile) {
                const proxy = JSON.parse(JSON.stringify(newFile));
                const response = proxy.response;
                if (response) {
                    this.deposit_voucher_path = response.data;
                }
            }
        },
        save() {
            const income = {
                accounts_id: null,
                status: 'PENDING',
                deposit_value: this.deposit_value,
                description: this.description,
                deposit_voucher_path: this.deposit_voucher_path,
            }
            this.$axios
                .post('/income', income)
                .then(response => {
                    this.showSnackBar(response.data)
                })
                .catch(error => {
                    this.showSnackBar(error.response.data)
                })
        },
        showSnackBar(response) {
            this.snackbar = true;
            this.message = response.message
            this.message_type = response.status ? 'blue' : 'pink'
        }
    },
}
</script>

<style scoped>
    .box-shadow-none {
        box-shadow: none !important;
    }

    .form-button {
        width: 100%;
        position: absolute;
        bottom: 10px;
    }

    .example-drag {
        width: 100%;
    }

    .example-drag .upload {
        width: 100%;
        display: flex;
        align-items: center;
        flex-direction: column;
    }

    .example-drag .upload > ul {
        border: 1px dashed grey;
        width: 100%;
        justify-content: center;
        display: flex;
        height: 100px;
        align-items: center;
    }

    .example-drag .upload .example-btn span {
        display: none;
    }

    .example-drag label.btn {
        margin-bottom: 0;
        margin-right: 1rem;
    }

    .example-drag .drop-active {
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        position: fixed;
        z-index: 9999;
        opacity: .6;
        text-align: center;
        background: #000;
    }

    .example-drag .drop-active h3 {
        margin: -.5em 0 0;
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        font-size: 40px;
        color: #fff;
        padding: 0;
    }
</style>
