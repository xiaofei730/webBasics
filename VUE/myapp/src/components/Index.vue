<template>
  <el-container class="height100">
  <el-header>
      <el-row>
        <el-col :span="4"><div class="header-left">刘能的后台</div></el-col>
        <el-col :span="16"><div class="header-middle">电商平台</div></el-col>
        <el-col :span="4"><input type="button" value="退出" class="header-right"></el-col>
      </el-row>
  </el-header>
  <el-container>
    <el-aside width="200px">
        <el-menu
      default-active="2"
      class="el-menu-vertical-demo"
      router=true>
      <el-submenu index="1">
        <template slot="title">
          <i class="el-icon-location"></i>
          <span>用户管理</span>
        </template>
        <el-menu-item index="userlist"><i class="el-icon-menu"></i>用户列表</el-menu-item>
      </el-submenu>
      <el-submenu index="1">
        <template slot="title">
          <i class="el-icon-location"></i>
          <span>权限管理</span>
        </template>
        <el-menu-item index="rolelist"><i class="el-icon-menu"></i>角色列表</el-menu-item>
        <el-menu-item index="authoritylist"><i class="el-icon-menu"></i>权限列表</el-menu-item>
      </el-submenu>
    </el-menu>
    </el-aside>
    <el-main>
        <router-view />
    </el-main>
  </el-container>
  </el-container>
</template>

<script>
export default {
  name: 'Index'
}
</script>

<style>
.height100{
    height: 100%;
}
.el-header{
    background-color: #b3c0d1;
    color: #333;
    text-align: center;
    line-height: 60px;
    font-size: 30px;
    padding: 0;
}
.header-left{
    background-color: red;
    text-align: center;
    width: 200px;
}
.header-middle{
    background-color: green;
}
.header-right{
    background-color: yellow;
    height: 60px;
    width: 120px;
    float: right;
    font-size: 30px;
}
.el-aside{
    background-color: #d3dce6;
    color: #333;
    text-align: center;
    line-height: 200px;
}
.el-main{
    background-color: #e9eef3;
    color: #333;
    text-align: center;
    line-height: 160px;
}
</style>
