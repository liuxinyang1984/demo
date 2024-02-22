<template>
  <div class="tree">
    <ul>
      <li>
        <a href="#">
          <div class="heda">ID:006</div>
          <div class="heda">姓名</div>
          <div class="heda">余额:</div>
          <div class="heda">电话:</div>
        </a>

        <ul>
          <li>
            <a href="#">
              <div class="heda"></div>
            </a>
          </li>
          <li>
            <a href="#">
              <div class="heda"></div>
            </a>
          </li>
          <li>
            <a href="#">
              <div class="heda"></div>
            </a>
          </li>
          <li>
            <a href="#">
              <div class="heda"></div>
            </a>
          </li>
          <li>
            <a href="#">
              <div class="heda"></div>
            </a>
          </li>
          <li>
            <a href="#">
              <div class="heda"></div>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
* {
  margin: 0;
  padding: 0;
  text-decoration: none;
}
.tree {
  background: white;
}
.tree ul {
  padding-top: 20px;
  position: relative;
  webkit-transition: all 0.5s;
  -moz-transition: all 0.5s;
  transition: all 0.3s;
  display: flex;
  justify-content: center;
}
.tree li {
  float: left;
  list-style: none;
  text-align: center;
  position: relative;
  padding: 20px 3px 0 3px;
  width:100%;
}
/*利用::before,::after作分支线*/
.tree li::before,
.tree li::after {
  content: "";
  position: absolute;
  top: 0;
  right: 50%;
  width: 50%;
  height: 20px;
  border-top: 3px solid #ccc;
}
.tree li:after {
  right: auto;
  left: 50%;
  border-left: 3px solid #ccc;
}
.tree li:first-child::before,
.tree li:last-child::after {
  border: 0 none;
}
.tree li:last-child::before {
  border-right: 3px solid #ccc;
  border-radius: 0 10px 0 0;
}
.tree li:first-child::after {
  border-radius: 10px 0 0 0;
}

/*删除仅只有一个分支的分支线*/
.tree li:only-child::before,
.tree li:only-child::after {
  border: none;
}
.tree li:only-child {
  padding-top: 0;
}

/*添加仅只有一个分支的下分支线*/
.tree ul ul::before {
  content: "";
  position: absolute;
  top: 0;
  left: 50%;
  border-left: 3px solid #ccc;
  width: 0;
  height: 20px;
}
.tree a {
  font-size: 12px;
  display: inline-block;
  color: #666;
  text-decoration: none;
  border-radius: 3px;
}

.heda {
  width: 50px;
  height: 60px;
  margin: auto;
  background: #ccc;
  text-align: center;
}
</style>
