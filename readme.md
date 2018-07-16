## 简介

一个新手入门级别的Laravel + Android应用，主要用于车辆的位置信息管理。系统2017年6月开始已在某单位运行，同时支持约100辆车辆实时在线监测。

## 框架

后台基于Laravel简单地实现了一个Restful Api，用于实时记录和读取车辆位置、车速、朝向、历史轨迹等信息。固定信息依赖PhpMyAdmin录入，如车牌号、车型、载客量等信息。实时信息由车载物联网依Restful Api进行上传。

前台基于Android端的OpenSteetMap组件开发，实现在和互联网隔离下的GIS信息和车辆信息实时显示。

## API

- 1.车载终端实时上传信息

方式：Get请求， http://服务器地址/{id}/edit？latitude=XXX&longitude=XXX&speed=XXX&angle=XXX&locatetime=XXX

功能：车载终端调用该API实现当前车辆位置、速度、角度等信息的上传。

源码：/app/Http/Controllers/BeiDouController.php 部分

- 2.返回所有车辆实时信息

方式：Get请求， http://服务器地址/     ， 返回值为Json

功能：Android调用该API获取所有车辆的实时信息

源码：/app/Http/Controllers/BeiDouController.php 部分

- 3.返回某辆车的实时信息

方式：Get请求， http://服务器地址/{id}， 返回值为Json

功能：Android调用该API获取车辆ID为{id}车辆的实时信息

源码：/app/Http/Controllers/BeiDouController.php 部分

- 4.返回某辆车的轨迹信息

方式：Get请求， http://服务器地址/trace/{id}， 返回值为Json

功能：Android调用该API获取车辆ID为{id}车辆的轨迹信息

源码：/app/Http/Controllers/BeiDouController.php 部分

## 数据库

数据库依据需求设计三个表，car表存储所有车辆固定信息，如颜色、车型、车牌、ID等。carpts存储车辆轨迹信息，用于车辆当日轨迹信息的显示。carpts_201801XX每日新建一个表，用于存储历史轨迹。

## 功能

有了后台对所有车辆实时信息的存储读取API，Android端实现可对车辆的电子围栏管理（出围栏报警）、位置、速度、车型等基本信息展示、轨迹展示、超速报警等等。
![车辆管理系统Android端](https://raw.githubusercontent.com/sm1314/VehicleSYS/master/screenshots/screen.png)

