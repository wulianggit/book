<?php

use Illuminate\Database\Seeder;

class PdtContentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\PdtContent::create([
            'product_id' => 1,
            'content'    => '编辑推荐
身出名门，Fackbook开源巨献，一经推出，立即吹响前端攻城狮入侵移动开发城池号角；
无论iOS平台，还是Android平台，React Native均有望一举成为移动开发的上选语言；
以BAT为首的一线国内互联网企业均以快速跟进研发、实践，各方向求职被面到的几率大增；
前端与移动开发融合，激进的React完全抛弃HTML和WebView，一举解决渲染问题，JS再建新王朝。
名人推荐
F8大会当天，React Native终于正式开源了，这着实让人兴奋了一把。因为我们知道React Native即将成为手机端上必不可少的开发模式之一。因为已经有React的开发经验，稍微浏览一下文档，很自然就能过渡到React Native的开发。稍微努力了一下，就能复刻手机淘 宝的首页，不到个把小时我这个菜鸟就差不多完成了大体的样子，让人惊讶于React Native这套技术方案的生产力。
——阿里资深前端工程师评React Native

React native充分利用了Facebook的现有轮子，是一个很优秀的集成作品，并且我相信这个团队对前端的了解很深刻，否则不可能让Native code“退居二线”。
——百度资深前端工程师评React Native',
        ]);
    }
}
