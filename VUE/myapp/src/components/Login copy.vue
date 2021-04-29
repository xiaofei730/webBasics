<template>
<div class="login-wrap">
  <el-form ref="form" :model="form" label-width="80px" class="login-form">
    <h2>用户登录</h2>
    <el-form-item label="用户名">
      <el-input v-model="form.username"></el-input>
    </el-form-item>
    <el-form-item label="密码" label-position="top">
      <el-input type="password" v-model="form.password"></el-input>
    </el-form-item>
    <el-form-item>
      <el-button type="primary" class="login-btn" @click="onSubmit">登录</el-button>
    </el-form-item>
  </el-form>
</div>
</template>

<script>
import Axios from 'axios'

export default {
  data () {
    return {
      form: {
        username: '',
        password: ''
      }
    }
  },
  methods: {
    onSubmit () {
      Axios.post('http://127.0.0.1/api/login', this.form).then((response) => {
        var {data, meta} = response.data
        console.log(data)
        if (meta.status === 200) {
          this.$message({
            messge: meta.msg,
            type: 'success'
          })
        } else {
          this.$message.error(meta.msg)
        }
      }).catch((err) => { console.log(err) })
      // alert(2)
      // this.form
    }
  }
}
</script>

<style>
.login-wrap {
  background-color: #324152;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}
.login-wrap .login-form{
  background-color: #fff;
  width: 400px;
  padding: 30px;
  border-radius: 5px;
}
.login-wrap .login-form .login-btn{
  width: 100%;
}
</style>
