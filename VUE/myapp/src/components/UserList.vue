<template>
  <div>
      <el-breadcrumb separator-class="el-icon-arrow-right">
        <el-breadcrumb-item :to="{ path: '/' }">首页</el-breadcrumb-item>
        <el-breadcrumb-item>用户管理</el-breadcrumb-item>
        <el-breadcrumb-item>用户列表</el-breadcrumb-item>
      </el-breadcrumb>
      <div style="margin-top: 5px;">
        <el-input placeholder="请输入内容" v-model="input3" class="input-with-select">
          <el-button slot="append" icon="el-icon-search"></el-button>
        </el-input>
        <el-button type="success">添加用户</el-button>
      </div>
      <el-table
        ref="singleTable"
        :data="tableData"
        highlight-current-row
        @current-change="handleCurrentChange"
        style="width: 100%">
        <el-table-column
        type="index"
        width="50">
        </el-table-column>
        <el-table-column
        property="name"
        label="姓名"
        width="120">
        </el-table-column>
        <el-table-column
        property="address"
        label="邮箱">
        </el-table-column>
        <el-table-column
        property="tel"
        label="电话">
        </el-table-column>
        <el-table-column
        label="状态">
        <el-switch
        v-model="value"
        active-color="#13ce66"
        inactive-color="#ff4949">
        </el-switch>
        </el-table-column>
        <el-table-column
        label="操作">
        <el-button type="primary" icon="el-icon-edit" circle></el-button>
        <el-button type="success" icon="el-icon-check" circle></el-button>
        <el-button type="danger" icon="el-icon-delete" circle></el-button>
        </el-table-column>
      </el-table>
  </div>
</template>

<script>
export default {
  data () {
    return {
      tableData: [{
        date: '2016-05-02',
        name: '王小虎',
        address: '上海市普陀区金沙江路 1518 弄',
        tel: '13233333333'
      }, {
        date: '2016-05-04',
        name: '王小虎',
        address: '上海市普陀区金沙江路 1517 弄',
        tel: '13233333333'
      }, {
        date: '2016-05-01',
        name: '王小虎',
        address: '上海市普陀区金沙江路 1519 弄',
        tel: '13233333333'
      }, {
        date: '2016-05-03',
        name: '王小虎',
        address: '上海市普陀区金沙江路 1516 弄',
        tel: '13233333333'
      }]
    }
  }
}
</script>

<style>
.el-main{
    line-height: 60px;
    text-align: left;
}
.input-with-select{
    width: 300px;
}
</style>
