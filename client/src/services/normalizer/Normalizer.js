export const platformMapper = Platform => ({
    websiteUrl: Platform.website_url,
    dr: Platform.dr,
    ma: Platform.ma,
    organicTraffic: Platform.organic_traffic,
    doFollowActive: Platform.do_follow_active,
    freeHomeFeaturedActive: Platform.free_home_featured_active,
    nicheEditLinkActive: Platform.niche_edit_link_active,
    articleWritingPrice: Platform.article_writing_price,
    nicheEditLinkPrice: Platform.niche_edit_link_price,
    contacts: Platform.contacts,
    price: Platform.price,
    email: Platform.email,
    comment: Platform.comment,
    topics: Platform.topics.map(topicMapper)
});

export const topicMapper = Topic => ({
    name: Topic.name
});