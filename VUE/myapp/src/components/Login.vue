<template>
<div class="login-wrap">
  <!-- rules 对应验证对象 -->
  <el-form ref="form" :model="form" :rules="form_rules" label-width="80px" class="login-form">
    <h2>用户登录</h2>
    <!-- prop 对应字段名字和具体验证规则 -->
    <el-form-item label="用户名" prop="username">
      <el-input v-model="form.username"></el-input>
    </el-form-item>
    <el-form-item label="密码" label-position="top" prop="password">
      <el-input type="password" v-model="form.password"></el-input>
    </el-form-item>
    <el-form-item>
      <el-button type="primary" class="login-btn" @click="onSubmit">登录</el-button>
    </el-form-item>
  </el-form>
</div>
</template>

<script>
// import Axios from 'axios'

export default {
  data () {
    return {
      form: {
        username: '',
        password: ''
      },
      //  验证对象，与整个form的rules属性值保持一致
      form_rules: {
        //  验证的名字和与要验证的字段名保持一致
        username: [
          //  具体针对某个字段的多个验证规则
          {required: true, message: '请输入用户名', trigger: 'blur'},
          {min: 3, max: 10, message: '长度在 3 到 10 个字符', trigger: 'blur'}
        ],
        password: [
          {required: true, message: '密码不能为空', trigger: 'blur'},
          {min: 3, max: 10, message: '长度在 3 到 10 个字符', trigger: 'blur'}
        ]
      }
    }
  },
  methods: {
    onSubmit () {
      this.$axios.post('http://127.0.0.1/api/login', this.form).then((response) => {
        var {data, meta} = response.data
        console.log(data)
        if (meta.status === 200) {
          this.$message({
            message: meta.msg,
            type: 'success'
          })
          // 拿到登录的返回数据后，需要将令牌（token）保持下来
          // 存令牌
          localStorage.setItem('token', 'data.token')
          // 取令牌
          console.log(localStorage.getItem('token'))
          //  编程式导航进行路由跳转
          this.$router.push({ path: '/' })
        //   this.$router.push({ name: 'HelloWorld' })
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
