<template>
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="card shadow sm">
                    <div class="card-body">
                        <h1 class="text-center">Регистрация</h1>
                        <hr/>
                        <form action="javascript:void(0)" @submit="register" class="row" method="post">
                            <div class="col-12" v-if="Object.keys(validationErrors).length > 0">
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        <li v-for="(value, key) in validationErrors" :key="key">{{ value[0] }}</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="form-group col-12 my-2 required">
                                <label for="city" class="control-label">Город</label>
                                <input type="text" name="city" v-model="user.city" id="city" class="form-control"
                                       required>
                            </div>

                            <div class="form-group col-12 my-2 required">
                                <label for="name" class="control-label">Название клиники</label>
                                <input type="text" name="name" v-model="user.name" id="name"
                                       class="form-control" required>
                            </div>

                            <div class="form-group col-12 my-2 required">
                                <label for="inn" class="control-label">ИНН</label>
                                <input type="text" name="inn" v-model="user.inn" id="inn"
                                       class="form-control" required>
                            </div>

                            <div class="form-group col-12 my-2">
                                <label for="address" class="control-label">Адрес клиники</label>
                                <input type="text" name="address" v-model="user.address"
                                       id="address" class="form-control">
                            </div>

                            <div class="form-group col-12 my-2">
                                <label for="site" class="control-label">Сайт клиники</label>
                                <input type="text" name="site" v-model="user.site" id="site"
                                       class="form-control">
                            </div>

                            <div class="form-group col-12 my-2 required">
                                <label for="fio" class="control-label">ФИО (полностью)</label>
                                <input type="text" name="fio" v-model="user.fio" id="fio" class="form-control" required>
                            </div>

                            <div class="form-group col-12 my-2 required">
                                <label for="job_title" class="control-label">Должность</label>
                                <input type="text" name="job_title" v-model="user.job_title" id="job_title"
                                       class="form-control" required>
                            </div>

                            <div class="form-group col-12 my-2 required">
                                <label for="phone" class="control-label">Номер телефона</label>
                                <input
                                    name="phone"
                                    v-model="user.phone"
                                    id="phone"
                                    class="form-control"
                                    v-maska="'+7 (###) ###-##-##'"
                                    placeholder="+7 (---) ---_--_--"
                                    required
                                >
                            </div>

                            <div class="form-group col-12 my-2">
                                <label for="email" class="control-label">E-mail</label>
                                <input
                                    type="email"
                                    name="email"
                                    v-model="user.email"
                                    id="email"
                                    class="form-control"
                                >
                            </div>


                            <div class="d-grid gap-2">
                                <button
                                    type="button"
                                    :disabled="processing || !agree"
                                    class="btn btn-primary btn-lg btn-block"
                                    @click="register"
                                >
                                    {{ processing ? "Пожалуйста, подождите" : "Зарегистрироваться" }}
                                </button>
                            </div>

                            <div class="agreement my-4">
                                <input
                                    type="checkbox"
                                    id="agreement"
                                    checked
                                    v-model="agree"
                                >
                                <label
                                    for="agreement"
                                >
                                    Нажимая кнопку "Зарегистрироваться" даю согласие на обработку моих персональных
                                    данных
                                    , а также ознакомлен с условиями и политикой в отношении их обработки
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'register',
    data() {
        return {
            user: {
                city: "",
                name: "",
                inn: "",
                address: "",
                site: "",
                fio: "",
                job_title: "",
                phone: "",
                email: "",
            },
            validationErrors: {},
            processing: false,
            agree: true,
        }
    },
    methods: {
        async register() {
            if (this.agree) {
                this.processing = true
                const regex = /(\s|-)/gi;
                this.user.role = 'clinic';
                let data = this.user;
                data.phone = data.phone.replaceAll(regex, "")
                await axios.post('api/v1/auth/step1', data).then(response => {
                    this.validationErrors = {}
                }).catch(({response}) => {
                    if (response.status === 422) {
                        this.validationErrors = response.data.errors
                    } else {
                        this.validationErrors = {}
                        alert(response.data.message)
                    }
                }).finally(() => {
                    this.processing = false
                })
            }
        }
    },
}
</script>

<style scoped>
.form-group.required .control-label:after {
    content: "*";
    color: red;
}

.agreement {
    display: flex;
    align-items: flex-start;
}

.agreement > input {
    margin-right: 22px;
    margin-top: 6px;
}
</style>
