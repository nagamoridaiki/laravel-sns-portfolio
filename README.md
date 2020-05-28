# 掲示板メッセンジャーアプリ

## Overview
 
テーマごとに記事を投稿し、ユーザーたちがメッセージを送受信できる
話題をもとに人が集まるアプリを作りました。

![](https://larasns.s3-ap-northeast-1.amazonaws.com/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88+2020-05-28+18.46.43.png)


![](https://larasns.s3-ap-northeast-1.amazonaws.com/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88+2020-05-28+19.53.10.png)


![](https://larasns.s3-ap-northeast-1.amazonaws.com/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88+2020-05-28+18.56.20.png
)


# 主な機能

* ユーザー登録/ログイン/ログアウト
* 記事の投稿/更新/削除
* 記事へのコメント
* 記事へのいいね
* タグごとの検索
* ユーザープロフィール（個人情報・顔写真アップロード・経歴・実績）
* 各ユーザーのフォロー
* 各ユーザーとのチャット


# インフラ構成図
![](https://larasns.s3-ap-northeast-1.amazonaws.com/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88+2020-05-28+19.39.19.png)


# 使用技術

バックエンド
* PHP7.3
* Laravel7.0

フロントエンド
* JavaScript
* Vue.js

インフラ
* AWS(VPC/EC2/RDS/Route53/ELB/ACM/S3/CloudFront/ECR/ECS)

環境構築
* Docker/docker-compose

  webサーバー
  * Nginx

  データベース
  * MySQL5.7（開発）
  * MySQL5.7（本番）

自動ツール
* circleCI/CD




